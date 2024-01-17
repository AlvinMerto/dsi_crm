<?php

namespace Modules\Assets\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Assets\Entities\Asset;
use Modules\Assets\Events\CreateAssets;
use Modules\Assets\Events\DestroyAssets;
use Modules\Assets\Events\UpdateAssets;
use Modules\Hrm\Entities\Employee;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (Auth::user()->can('assets manage')) {
            $assets = Asset::where('created_by', '=', creatorId())->get();
            return view('assets::index', compact('assets'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (Auth::user()->can('assets create')) {
            $employees = [];
            if (module_is_active('Hrm')) {

                $employees = User::where('workspace_id', getActiveWorkSpace())->where('created_by', '=', Auth::user()->id)->emp()->get()->pluck('name', 'id');
            }
            if (module_is_active('CustomField')) {

                $customFields =  \Modules\CustomField\Entities\CustomField::where('workspace_id', getActiveWorkSpace())->where('module', '=', 'Assets')->where('sub_module', 'assets')->get();
            } else {

                $customFields = null;
            }
            return view('assets::create', compact('customFields', 'employees'));
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
        if (Auth::user()->can('assets create')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'purchase_date' => 'required',
                    'supported_date' => 'required',
                    'amount' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            if (module_is_active('Hrm')) {

                $employees = Employee::where('user_id', '=', $request->employee_id)->first();
            }

            $assets = new Asset();
            $assets->user_id = $request->employee_id;
            $assets->name = $request->name;
            $assets->purchase_date = $request->purchase_date;
            $assets->supported_date = $request->supported_date;
            $assets->amount = $request->amount;
            $assets->description = $request->description;
            $assets->created_by = \Auth::user()->id;
            $assets->workspace_id = getActiveWorkSpace();
            $assets->save();

            event(new CreateAssets($request,$assets));


            if (module_is_active('CustomField')) {
                \Modules\CustomField\Entities\CustomField::saveData($assets, $request->customField);
            }

            return redirect()->route('asset.index')->with('success', __('Assets successfully created.'));
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
        return redirect()->route('asset.index')->with('error', __('Permission denied.'));
        return view('assets::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        if (Auth::user()->can('assets edit')) {
            $employees = [];
            if (module_is_active('Hrm')) {

                $employees = User::where('workspace_id', getActiveWorkSpace())->where('created_by', '=', Auth::user()->id)->emp()->get()->pluck('name', 'id');
            }
            $asset = Asset::find($id);
            if (module_is_active('CustomField')) {
                $asset->customField = \Modules\CustomField\Entities\CustomField::getData($asset, 'Assets', 'assets');
                $customFields             = \Modules\CustomField\Entities\CustomField::where('workspace_id', '=', getActiveWorkSpace())->where('module', '=', 'Assets')->where('sub_module', 'assets')->get();
            } else {
                $customFields = null;
            }

            return view('assets::edit', compact('employees', 'asset', 'customFields'));
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
        if (Auth::user()->can('assets edit')) {
            $asset = Asset::find($id);
            if ($asset->created_by == \Auth::user()->id) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'name' => 'required',
                        'purchase_date' => 'required',
                        'supported_date' => 'required',
                        'amount' => 'required',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
                if (module_is_active('Hrm')) {

                    $employees = Employee::where('user_id', '=', $request->employee_id)->first();
                }
                if (module_is_active('CustomField')) {
                    \Modules\CustomField\Entities\CustomField::saveData($asset, $request->customField);
                }
                $asset->user_id = $request->employee_id;
                $asset->name = $request->name;
                $asset->purchase_date = $request->purchase_date;
                $asset->supported_date = $request->supported_date;
                $asset->amount = $request->amount;
                $asset->description = $request->description;
                $asset->save();

                event(new UpdateAssets($request,$asset));

                return redirect()->route('asset.index')->with('success', __('Assets successfully updated.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
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
        if (Auth::user()->can('assets delete')) {
            $asset = Asset::find($id);
            if ($asset) {

            event(new DestroyAssets($asset));

                $asset->delete();
                return redirect()->route('asset.index')->with('success', __('Assets successfully deleted.'));
            } else {
                return redirect()->route('asset.index')->with('error', __('Assets not found.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function fileImportExport()
    {
        if (Auth::user()->can('assets import')) {
            return view('assets::import');
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function fileImport(Request $request)
    {
        if (Auth::user()->can('assets import')) {
            session_start();

            $error = '';

            $html = '';

            if ($request->file->getClientOriginalName() != '') {
                $file_array = explode(".", $request->file->getClientOriginalName());

                $extension = end($file_array);
                if ($extension == 'csv') {
                    $file_data = fopen($request->file->getRealPath(), 'r');

                    $file_header = fgetcsv($file_data);
                    $html .= '<table class="table table-bordered"><tr>';

                    for ($count = 0; $count < count($file_header); $count++) {
                        $html .= '
                                <th>
                                    <select name="set_column_data" class="form-control set_column_data" data-column_number="' . $count . '">
                                    <option value="">Set Count Data</option>
                                    <option value="name">Asset Name</option>
                                    <option value="purchase_date">Purchase Date</option>
                                    <option value="supported_date">Supported Date</option>
                                    <option value="amount">Amount</option>
                                    <option value="description">Description</option>
                                    </select>
                                </th>
                                ';
                    }
                    $html .= '</tr>';
                    $limit = 0;
                    while (($row = fgetcsv($file_data)) !== false) {
                        $limit++;

                        $html .= '<tr>';

                        for ($count = 0; $count < count($row); $count++) {
                            $html .= '<td>' . $row[$count] . '</td>';
                        }

                        $html .= '</tr>';

                        $temp_data[] = $row;
                    }
                    $_SESSION['file_data'] = $temp_data;
                } else {
                    $error = 'Only <b>.csv</b> file allowed';
                }
            } else {

                $error = 'Please Select CSV File';
            }
            $output = array(
                'error' => $error,
                'output' => $html,
            );

            echo json_encode($output);
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    public function fileImportModal()
    {
        if (Auth::user()->can('assets import')) {
            return view('assets::import_modal');
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function assetsImportdata(Request $request)
    {
        if (Auth::user()->can('assets import')) {
            session_start();
            $html = '<h3 class="text-danger text-center">Below data is not inserted</h3></br>';
            $flag = 0;
            $html .= '<table class="table table-bordered"><tr>';
            $file_data = $_SESSION['file_data'];

            unset($_SESSION['file_data']);

            $user = \Auth::user();


            foreach ($file_data as $row) {
                $asset = Asset::where('created_by', creatorId())->where('workspace_id', getActiveWorkSpace())->Where('name', 'like', $row[$request->name])->get();

                if ($asset->isEmpty()) {

                    try {
                        Asset::create([
                            'name' => $row[$request->name],
                            'purchase_date' => $row[$request->purchase_date],
                            'supported_date' => $row[$request->supported_date],
                            'amount' => $row[$request->amount],
                            'description' => $row[$request->description],
                            'created_by' => creatorId(),
                            'workspace_id' => getActiveWorkSpace(),
                        ]);
                    } catch (\Exception $e) {
                        $flag = 1;
                        $html .= '<tr>';

                        $html .= '<td>' . $row[$request->name] . '</td>';
                        $html .= '<td>' . $row[$request->purchase_date] . '</td>';
                        $html .= '<td>' . $row[$request->supported_date] . '</td>';
                        $html .= '<td>' . $row[$request->amount] . '</td>';
                        $html .= '<td>' . $row[$request->description] . '</td>';

                        $html .= '</tr>';
                    }
                } else {
                    $flag = 1;
                    $html .= '<tr>';

                    $html .= '<td>' . $row[$request->name] . '</td>';
                    $html .= '<td>' . $row[$request->purchase_date] . '</td>';
                    $html .= '<td>' . $row[$request->supported_date] . '</td>';
                    $html .= '<td>' . $row[$request->amount] . '</td>';
                    $html .= '<td>' . $row[$request->description] . '</td>';

                    $html .= '</tr>';
                }
            }

            $html .= '
                            </table>
                            <br />
                            ';
            if ($flag == 1) {

                return response()->json([
                    'html' => true,
                    'response' => $html,
                ]);
            } else {
                return response()->json([
                    'html' => false,
                    'response' => 'Data Imported Successfully',
                ]);
            }
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }
}
