<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GroupController extends Controller
{

    /* Get Table Column List */
    private function getColumns(){
        $columns = ['#', 'group_name', 'account_type', 'account_name', 'account_number', 'members', 'action'];
        return $columns;
    }

    /* Get DataTable Column List */

    private function getDataTableColumns(){
        $columns = ['#', 'name', 'account_type', 'account_name', 'account_number', 'members', 'action'];
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

    /* Get Datatable value */
    public function getDataTable($user_groups){

        if(!empty($user_groups)){
            return DataTables::of($user_groups)
                ->addColumn('#', function(){ return ++$this->index; })
                ->addColumn('name', function($row){ return $row->name; })
                ->addColumn('account_type', function($row){ return $row->account_type; })
                ->addColumn('account_name', function($row){ return $row->account_name; })
                ->addColumn('account_number', function($row){ return $row->account_number; })
                ->addColumn('members', function($group) {
                    $members = '';
                    foreach ($group->members as $member) {
                        $members .= ucfirst($member->name) . ',';
                    }
                    return rtrim($members, ',');
                })
                ->addColumn('action', function() {
                    return '<a href="#" class="btn btn-sm btn-primary">Edit</a>
                            <a href="#" class="btn btn-sm btn-danger">Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }else{
            return DataTables::of([])->make(true);
        }

    }

}
