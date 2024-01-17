<?php

namespace Modules\SupportTicket\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Sales\Entities\Contact;
use Modules\Sales\Entities\SalesAccount;
use Modules\SupportTicket\Entities\Conversion;
use Modules\SupportTicket\Entities\Ticket;
use Modules\SupportTicket\Entities\TicketCategory;
use Modules\SupportTicket\Entities\TicketField;
use Modules\SupportTicket\Events\CreateTicket;
use Modules\SupportTicket\Events\DestroyTicket;
use Modules\SupportTicket\Events\UpdateTicket;
use Rawilk\Settings\Support\Context;

class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($status = '')
    {
        if (Auth::user()->can('ticket manage')) {
            $tickets = Ticket::with('workspace')->select(
                [
                    'tickets.*',
                    'ticket_categories.name as category_name',
                    'ticket_categories.color',
                ]
            )->join('ticket_categories', 'ticket_categories.id', '=', 'tickets.category');
            if ($status == 'in-progress') {
                $tickets->where('status', '=', 'In Progress');
            } elseif ($status == 'on-hold') {
                $tickets->where('status', '=', 'On Hold');
            } elseif ($status == 'closed') {
                $tickets->where('status', '=', 'Closed');
            }
            $tickets = $tickets->where('tickets.workspace_id', getActiveWorkSpace())->orderBy('id', 'desc')->get();

            return view('supportticket::ticket.index', compact('tickets', 'status'));
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
        if (Auth::user()->can('ticket create')) {
            $fields = TicketField::where('created_by', creatorId())->where('custom_id', '>', '6')->get();
            $categories = TicketCategory::where('created_by', creatorId())->where('workspace_id', getActiveWorkSpace())->get();
            $accounts      = SalesAccount::where('workspace', getActiveWorkSpace())->get()->pluck('name', 'id');
            $all_contacts="";
            if(isset($type) && $type=="contact")
            {
                $all_contacts = Contact::where('created_by', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name','id');
            }

            return view('supportticket::ticket.create', compact('categories', 'fields','accounts','type','id','all_contacts'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $user = \Auth::user();
        if (Auth::user()->can('ticket create')) {
            $validation = [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'category' => 'required|string|max:255',
                'subject' => 'required|string|max:255',
                'status' => 'required|string|max:100',
                'account_id' =>'required',
            ];

            $validator = \Validator::make(
                $request->all(),
                $validation
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->withInput()->with('error', $messages->first());
            }

            $post = $request->all();
            $post['ticket_id'] = time();
            $post['created_by'] = $user->id;
            $post['workspace_id'] = getActiveWorkSpace();
            $data = [];
            if ($request->hasfile('attachments')) {
                foreach ($request->file('attachments') as $file) {

                    $name = $file->getClientOriginalName();
                    $data[] = [
                        'name' => $name,
                        'path' => 'uploads/tickets/' . $post['ticket_id'] . '/' . $name,
                    ];
                    multi_upload_file($file, 'attachments', $name, 'tickets/' . $post['ticket_id']);
                }
            }
            if(isset($request->account_id))
            {
                $post['account_id'] = $request->account_id;
            }

            if(isset($request->contact_id))
            {
                $post['contact_id'] = $request->contact_id;
            }

            $post['attachments'] = json_encode($data);
            $post['created_by'] = creatorId();
            $post['updated_by'] = creatorId();
            $ticket = Ticket::create($post);
            TicketField::saveData($ticket, $request->fields);

             // first parameter request second parameter ticket
             event(new CreateTicket($request, $ticket));

            if (!empty(company_setting('New Ticket')) && company_setting('New Ticket') == true) {
                $user = User::where('id', $ticket->created_by)->where('workspace_id', '=', getActiveWorkSpace())->first();

                $uArr = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'category' => $request->category,
                    'subject' => $request->subject,
                    'status' => $request->status,
                    'description' => $request->description,
                ];

                try {
                    $resp = EmailTemplate::sendEmailTemplate('New Ticket', [$request->email], $uArr);
                } catch (\Exception $e) {
                    $resp['error'] = $e->getMessage();
                }

                // Send Email to
                if (isset($resp['error'])) {
                    session('smtp_error', '<span class="text-danger ml-2">' . $resp['error'] . '</span>');
                }
            }
            Session::put('ticket_id', ' <a class="text text-primary" target="_blank" href="' . route('ticket.view', [$ticket->workspace->slug, \Illuminate\Support\Facades\Crypt::encrypt($ticket->ticket_id)]) . '"><b>' . __('Your unique ticket link is this.') . '</b></a>');
            return redirect()->route('support-tickets.index')->with('success', __('Ticket created successfully.'));
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
        return redirect()->route('support-tickets.index');

        return view('supportticket::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Ticket $ticket, $id)
    {

        $user = \Auth::user();
        if (Auth::user()->can('ticket show')) {
            $ticket = Ticket::find($id);
            if ($ticket) {
                $fields = TicketField::where('created_by', creatorId())->where('workspace_id', '=', getActiveWorkSpace())->where('custom_id', '>', '6')->get();
                $ticket->fields = TicketField::getData($ticket);
                $categories = TicketCategory::where('created_by', creatorId())->where('workspace_id', getActiveWorkSpace())->get();
                return view('supportticket::ticket.edit', compact('ticket', 'categories', 'fields'));
            } else {
                return view('403');
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
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
        if (Auth::user()->can('ticket edit')) {
            $ticket = Ticket::find($id);
            $validation = [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'category' => 'required|string|max:255',
                'subject' => 'required|string|max:255',
                'status' => 'required|string|max:100',
            ];
            $validator = \Validator::make(
                $request->all(),
                $validation
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->withInput()->with('error', $messages->first());
            }
            if ($request->hasfile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $name = $file->getClientOriginalName();
                    $data[] = [
                        'name' => $name,
                        'path' => 'uploads/tickets/' . $ticket->ticket_id . '/' . $name,
                    ];
                    multi_upload_file($file, 'attachments', $name, 'tickets/' . $ticket->ticket_id);
                }
                if ($request->hasfile('attachments')) {
                    $json_decode = json_decode($ticket->attachments);
                    $attachments = json_encode(array_merge($json_decode, $data));
                } else {
                    $attachments = json_encode($data);
                }
                $ticket->attachments = isset($attachments) ? $attachments : null;
            }



            TicketField::saveData($ticket, $request->fields);

            event(new UpdateTicket($request, $ticket));

            $ticket->name = !empty($request->name) ? $request->name : '';
            $ticket->email = !empty($request->email) ? $request->email : '';
            $ticket->category = !empty($request->category) ? $request->category : '';
            $ticket->subject = !empty($request->subject) ? $request->subject : '';
            $ticket->status = !empty($request->status) ? $request->status : '';
            $ticket->description = !empty($request->description) ? $request->description : '';
            $ticket->updated_by = \Auth::user()->id;
            $ticket->save();

            return redirect()->back()->with('success', __('Ticket Update  successfully'));
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
        if (Auth::user()->can('ticket delete')) {
            $ticket = Ticket::find($id);
            $conversions = Conversion::where('ticket_id', $ticket->id)->get();
            if (count($conversions) > 0) {
                $conversions = Conversion::where('ticket_id', $ticket->id)->delete();
            }
            delete_folder('tickets/' . $ticket->ticket_id);

            event(new DestroyTicket($ticket));

            $ticket->delete();
            return redirect()->back()->with('success', __('Ticket Deleted successfully'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function attachmentDestroy($ticket_id, $id)
    {
        $user = \Auth::user();
        $ticket = Ticket::find($ticket_id);
        $attachments = json_decode($ticket->attachments);
        if (isset($attachments[$id])) {
            delete_file($attachments[$id]->path);
            unset($attachments[$id]);

            $ticket->attachments = json_encode(array_values($attachments));
            $ticket->save();

            return redirect()->back()->with('success', __('Attachment deleted successfully'));
        } else {
            return redirect()->back()->with('error', __('Attachment is missing'));
        }
    }
    public function storeNote($ticketID, Request $request)
    {

        $user = \Auth::user();

        $validation = [
            'note' => ['required'],
        ];
        $validator = \Validator::make(
            $request->all(),
            $validation
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->withInput()->with('error', $messages->first());
        }

        $ticket = Ticket::find($ticketID);
        if ($ticket) {
            $ticket->note = $request->note;
            $ticket->save();

            return redirect()->back()->with('success', __('Ticket note saved successfully'));
        } else {
            return view('403');
        }
    }


    public function storeCustomFields(Request $request)
    {

        $order = 0;

        $userContext = new Context(['user_id' => \Auth::user()->id, 'workspace_id' => getActiveWorkSpace()]);
        if ($request->has('faq_is_on')) {
            \Settings::context($userContext)->set('faq_is_on', $request->faq_is_on);
        } else {
            \Settings::context($userContext)->set('faq_is_on', 'off');
        }
        if ($request->has('knowledge_base_is_on')) {
            \Settings::context($userContext)->set('knowledge_base_is_on', $request->knowledge_base_is_on);
        } else {
            \Settings::context($userContext)->set('knowledge_base_is_on', 'off');
        }


        foreach ($request->fields as $key => $field) {
            $f = TicketField::where('workspace_id', getActiveWorkSpace())->where('id', $field['id'])->first();
            $only = TicketField::find($field['id']);

            if ($f) {
                $f->name = $field['name'];
                $f->placeholder = $field['placeholder'];
                $f->width = $field['width'];
                $f->order = $order;
                $f->workspace_id = getActiveWorkSpace();
                $f->save();
                $order++;
            } elseif ($only) {
                $new = $only->replicate();
                $new->name = $field['name'];
                $new->placeholder = $field['placeholder'];
                $new->width = $field['width'];
                $new->order = $order;
                $new->workspace_id = getActiveWorkSpace();
                $new->save();
                $order++;
            }
        }

        $rules = [
            'fields' => 'required|present|array',
        ];
        $attributes = [];

        if ($request->fields) {
            foreach ($request->fields as $key => $val) {
                $rules['fields.' . $key . '.name'] = 'required|max:255';
                $attributes['fields.' . $key . '.name'] = __('Field Name');
            }
        }

        $validator = \Validator::make($request->all(), $rules, [], $attributes);
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $field_ids = TicketField::where('created_by', creatorId())->orderBy('order')->pluck('id')->toArray();

        $order = 0;
        $custom_id = 1;
        $id = 1;
        foreach ($request->fields as $key => $field) {
            $fieldObj = new TicketField();
            if (isset($field['id']) && !empty($field['id'])) {
                $fieldObj = TicketField::find($field['id']);
                if (($key = array_search($fieldObj->id, $field_ids)) !== false) {
                    unset($field_ids[$key]);
                }
            }

            $fieldObj->name = $field['name'];
            $fieldObj->placeholder = $field['placeholder'];
            if (isset($field['type']) && !empty($field['type'])) {
                if (isset($fieldObj->id) && $fieldObj->id > 6) {
                    $fieldObj->type = $field['type'];
                } elseif (!isset($fieldObj->id)) {
                    $fieldObj->type = $field['type'];
                }
            }
            $fieldObj->width = (isset($field['width'])) ? $field['width'] : '12';


            if(isset($field['status']))
            {
                if(isset($fieldObj->id) && $fieldObj->id > 7)
                {
                    $fieldObj->status = $field['status'];
                }
                elseif(!isset($fieldObj->id))
                {
                    $fieldObj->status = $field['status'];
                }
            }


            $fieldObj->created_by = Auth::id();
            $fieldObj->order      = $order++;
            $fieldObj->created_by = \Auth::user()->id;
            $fieldObj->workspace_id = getActiveWorkSpace();
            $fieldObj->save();
            if( $fieldObj->custom_id == 0){
                $fieldObj->custom_id      = $fieldObj->id;
               $fieldObj->save();
            }
        }

        if(!empty($field_ids) && count($field_ids) > 0)
        {
            TicketField::whereIn('id', $field_ids)->where('status', 1)->delete();
        }


        return redirect()->back()->with('success', __('Fields Saves Successfully.!'));
    }

    public function grid($status = '')
    {
        if (Auth::user()->can('ticket manage')) {
            $tickets = Ticket::with('workspace')->select(
                [
                    'tickets.*',
                    'ticket_categories.name as category_name',
                    'ticket_categories.color',
                ]
            )->join('ticket_categories', 'ticket_categories.id', '=', 'tickets.category');
            if ($status == 'in-progress') {
                $tickets->where('status', '=', 'In Progress');
            } elseif ($status == 'on-hold') {
                $tickets->where('status', '=', 'On Hold');
            } elseif ($status == 'closed') {
                $tickets->where('status', '=', 'Closed');
            }
            $tickets = $tickets->where('tickets.workspace_id', getActiveWorkSpace())->orderBy('id', 'desc')->get();

            return view('supportticket::ticket.grid', compact('tickets', 'status'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function contactdetail(Request $request)
    {
        $contacts=Contact::where('account',$request->account_id)->get();

        $contact="<option value=''>Select Contact</option>";
        foreach($contacts as $value)
        {
            $contact .= "<option value='".$value->id."'>".$value->name."</option>";

        }

        return $contact;
    }
}
