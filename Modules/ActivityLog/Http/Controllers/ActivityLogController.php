<?php

namespace Modules\ActivityLog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ActivityLog\Entities\AllActivityLog;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if(module_is_active('ActivityLog'))
        {
            if (\Auth::user()->can('activitylog manage')) {

                $modules = AllActivityLog::where('created_by', '=', creatorId())->where('workspace', '=', getActiveWorkSpace())->groupBy('module')->get()->pluck('module')->toArray();

                $activitys = AllActivityLog::where('created_by', '=', creatorId())->where('workspace', '=', getActiveWorkSpace())->orderBy('created_at', 'desc')->get();
                if ($modules) {
                    $activitys = AllActivityLog::where('created_by', '=', creatorId())->where('workspace', '=', getActiveWorkSpace())->orderBy('created_at', 'desc')->where('module', '=', $modules[0])->get();
                }
                if (!empty($request->filter)) {
                    $activitys = AllActivityLog::where('created_by', '=', creatorId())->where('workspace', '=', getActiveWorkSpace())->where('module', '=', $request->filter)->orderBy('created_at', 'desc')->get();
                }

                return view('activitylog::index', compact('activitys', 'modules'))->with('i', (request()->input('page', 1) - 1) * 10);
            } else {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('activitylog::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return redirect()->route('activitylog.index')->with('error', __('Permission Denied.'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('activitylog::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if (\Auth::user()->can('activitylog delete')) {
            $activity = AllActivityLog::find($id);
            $activity->delete();

            return redirect()->back()->with('success', __('Activity successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
}
