<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GroupController extends Controller
{

    /* Get Table Column List */
    private function getColumns(){
        $columns = ['#', 'group_name', 'account_type', 'account_name', 'account_number', 'members'];
        return $columns;
    }

    /* Get DataTable Column List */

    private function getDataTableColumns(){
        $columns = ['#', 'name', 'account_type', 'account_name', 'account_number', 'members'];
        return $columns;
    }

    public function index(Request $request){
        if( $request->ajax() ){
            $token = get_data('token');
            $url = 'https://collectivesaverapi.naimur.com.bd/api/v1/groups';

            if(!empty($token)){
                $response = send_request('get', $url, '', $token);
                if(!empty($response) && !empty($response->status)){
                    $user_groups = $response->data->user_groups;
                    return $this->getDataTable($user_groups);
                }
            }
            return DataTables::of([])->make(true);
        }
        $data = get_data('user_data');
        $params = [
            'tableColumns'      => $this->getColumns(),
            'dataTableColumns'  => $this->getDataTableColumns(),
            'dataTableUrl'      => Null,
            'pageTitle'         => 'Groups List',
            'tableStyleClass'   => 'bg-success',
            'data'              => $data,
            'create'            => route('group.create')
        ];
        return view('datatable.table', $params);
    }

    /* Create Group */
    public function create(Request $request){
        $data = get_data('user_data');
        $params = [
           'title' => 'Group Create',
           'data' => $data,
           'form_url' => route('group.store')
        ];
        return view('groups.create', $params);
    }

    /* Create Edit */
    public function edit(Request $request){
        $token = get_data('token');
        $id = $request->id;
        $url = 'https://collectivesaverapi.naimur.com.bd/api/v1/groups/' .$id;
        $response = send_request('', $url, '', $token);
        if(!empty($response) && !empty($response->status)){
            $data = get_data('user_data');
            $params = [
               'title' => 'Group Create',
               'data' => $data,
               'group_data' => $response->data,
               'form_url' => route('group.store')
            ];
            return view('groups.create', $params);
        }
        else{

        }

    }

    /* Group Store */
    public function store(Request $request){
        $token = get_data('token');
        $url = 'https://collectivesaverapi.naimur.com.bd/api/v1/create_group';

        if(!empty($request->id)){
            $url = 'https://collectivesaverapi.naimur.com.bd/api/v1/create_group/' . $request->id;
        }

        $data = [
            'name' => $request->name,
            'account_type' => $request->account_type,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'members' => $request->members,
            'details' => $request->details,
        ];
        $response = send_request('post', $url, $data, $token);
        if(!empty($response) && !empty($response->status)){
            set_alert('success', $response->message);
            return back();
        }
        else{
            set_alert('error', $response->message);
            return back();
        }
    }

    /* Get Datatable value */
    public function getDataTable($user_groups){

        if(!empty($user_groups)){
            return DataTables::of($user_groups)
                ->addColumn('#', function(){ return ++$this->index; })
                ->addColumn('name', function($row){
                    $rowDetails = '<div class="row-option">';
                    $rowDetails .= '<span>' . $row->name . '</span>';
                    $rowDetails .= '<div class="button-group mt-2">';
                    $rowDetails .= '<a href="' . route('group.edit', $row->id ) . '">Edit</a> | ';
                    $rowDetails .= '<a href="#">Delete</a>';
                    $rowDetails .= '</div>';
                    $rowDetails .= '</div>';
                    return $rowDetails;
                })
                ->addColumn('account_type', function($row){ return $row->account_type; })
                ->addColumn('account_name', function($row){ return $row->account_name; })
                ->addColumn('account_number', function($row){ return $row->account_number; })
                ->addColumn('members', function($group) {
                    $members = '';
                    foreach ($group->members as $member) {
                        if (!empty($member[0])) {
                            $members .= ucfirst($member[0]) . ', ';
                        }
                    }
                    return rtrim($members, ', ');
                })
                ->rawColumns(['name'])
                ->make(true);
        }else{
            return DataTables::of([])->make(true);
        }

    }

}
