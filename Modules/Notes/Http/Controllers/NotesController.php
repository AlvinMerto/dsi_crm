<?php

namespace Modules\Notes\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Notes\Entities\Notes;
use Modules\Notes\Events\CreateNotes;
use Modules\Notes\Events\DestroyNotes;
use Modules\Notes\Events\UpdateNotes;
use Modules\Sales\Entities\Contact;
use Modules\Sales\Entities\Opportunities;
use Modules\Sales\Entities\SalesAccount;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (Auth::user()->can('note manage')) {
            $personal_notes = Notes::where('type', '=', 'personal')->where('workspace_id', '=', getActiveWorkSpace())->where('created_by', '=', creatorId())->get();
            $shared_notes = Notes::where('type', '=', 'shared')->where('workspace_id', '=', getActiveWorkSpace())
                ->whereRaw("find_in_set('" . \Auth::user()->id . "',notes.assign_to)")
                ->get();
            return view('notes::index', compact('shared_notes', 'personal_notes'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($type,$id)
    {
        if (Auth::user()->can('note create')) {
            $users = User::allusers()->where('workspace_id', getActiveWorkSpace())->get();
            $accounts      = SalesAccount::where('workspace', getActiveWorkSpace())->get()->pluck('name', 'id');
            $all_contacts="";
            if(isset($type) && ($type=="contact"))
            {
                $all_contacts = Contact::where('created_by', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name','id');
            }
            return view('notes::create', compact('users','accounts','type','id','all_contacts'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('note create')) {
            try {
                $request->validate([
                    'title' => 'required',
                    'text' => 'required',
                    'color' => 'required',
                    'account_id' => 'required',
                ]);

                $assign_to = $request->assign_to;
                $assign_to[] = Auth::user()->id;
                $note = new Notes();
                $note->title = $request->title;
                $note->text = $request->text;
                $note->color = $request->color;
                $note->type = $request->type;
                $note->assign_to = implode(',', $assign_to);
                $note->workspace_id = getActiveWorkSpace();
                $note->account_id = isset($request->account_id)?$request->account_id:0;
                $note->contact_id = isset($request->contact_id)?$request->contact_id:0;
                $note->opportunity_id = isset($request->opportunity_id)?$request->opportunity_id:0;
                $note->created_by = creatorId();
                $note->updated_by = creatorId();
                $note->save();

                event(new CreateNotes($request, $note));
                return redirect()->back()->with('success', __('Note Created Successfully!'));

            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return redirect()->route('notes.index')->with('error', __('Permission denied.'));
        return view('notes::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        if (Auth::user()->can('note edit')) {
            $note = Notes::where('workspace_id', '=', getActiveWorkSpace())->where('created_by', '=', creatorId())->where('id', '=', $id)->first();

            $note->assign_to = explode(',', $note->assign_to);
            $users = User::where('workspace_id', getActiveWorkSpace())->where('type', '!=', 'admin')->get();
            $accounts = SalesAccount::where('workspace', getActiveWorkSpace())->get()->pluck('name', 'id');
            $contacts = Contact::where('account',$note->account_id)->get()->pluck('name','id');
            $opportunities=Opportunities::where('contact',$note->contact_id)->get()->pluck('name','id');

            return view('notes::edit', compact('note', 'users','accounts','contacts','opportunities'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('note edit')) {
            try {
                $request->validate([
                    'title' => 'required',
                    'text' => 'required',
                    'color' => 'required',
                    'account_id' => 'required',
                ]);
                $assign_to = $request->assign_to;
                $assign_to[] = Auth::user()->id;
                $note = Notes::where('workspace_id', '=', getActiveWorkSpace())->where('created_by', '=', Auth::user()->id)->where('id', '=', $id)->first();
                $note->title = $request->title;
                $note->text = $request->text;
                $note->color = $request->color;
                $note->type = $request->type;
                $note->assign_to = implode(',', $assign_to);
                $note->account_id = $request->account_id;
                $note->contact_id = isset($request->contact_id)?$request->contact_id:0;
                $note->opportunity_id = isset($request->opportunity_id)?$request->opportunity_id:0;
                $note->updated_by=\Auth::user()->id;
                $note->save();

                event(new UpdateNotes($request, $note));

                return redirect()->back()->with('success',__('Note Updated Successfully!'));

            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if (Auth::user()->can('note delete')) {
            $objUser = Auth::user();
            $note = Notes::find($id);
            if ($note->created_by == $objUser->id) {

                event(new DestroyNotes($note));

                $note->delete();
                return redirect()->route('notes.index')->with('success', __('Note Deleted Successfully!'));
            } else {
                return redirect()->route('notes.index')->with('error', __("You can't delete Note!"));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
