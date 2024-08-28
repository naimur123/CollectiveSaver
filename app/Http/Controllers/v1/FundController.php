<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FundController extends Controller
{
    /* Get Table Column List */
    private function getColumns(){
        $columns = ['#', 'year', 'month', 'day', 'total_amount'];
        return $columns;
    }

    /* Get DataTable Column List */
    private function getDataTableColumns(){
        $columns = ['#', 'year', 'month', 'day', 'total_amount'];
        return $columns;
    }

    /* Index */
    public function index(Request $request){
        if( $request->ajax() ){
            $token = get_data('token');
            $url = 'https://collectivesaverapi.naimur.com.bd/api/v1/user_group_fund';

            if(!empty($token)){
                $response = send_request('get', $url, '', $token);
                if(!empty($response) && !empty($response->status)){
                    $user_groups_funds = $response->data;
                    return $this->getDataTable($user_groups_funds);
                }
            }
            return DataTables::of([])->make(true);
        }
        $data = get_data('user_data');
        $params = [
            'tableColumns'      => $this->getColumns(),
            'dataTableColumns'  => $this->getDataTableColumns(),
            'dataTableUrl'      => Null,
            'pageTitle'         => 'Group Funds List',
            'tableStyleClass'   => 'bg-success',
            'data'              => $data,
            'create'            => route('group.fund.create')
        ];
        return view('datatable.table', $params);
    }

    /* Group Fund Create */
    public function create(Request $request){
        $data = get_data('user_data');
        $token = get_data('token');
        $url = 'https://collectivesaverapi.naimur.com.bd/api/v1/groups';

        $user_groups = '';
        if(!empty($token)){
            $response = send_request('get', $url, '', $token);
            if(!empty($response) && !empty($response->status)){
                $user_groups = $response->data->user_groups;
            }
        }

        $params = [
           'title' => 'Group Fund Create',
           'data' => $data,
           'user_groups' => $user_groups,
           'form_url' => route('group.fund.store')
        ];
        return view('funds.create', $params);
    }

    /* Get Datatable value */
    public function getDataTable($user_groups_funds){

        if(!empty($user_groups_funds)){
            return DataTables::of($user_groups_funds)
                ->addColumn('#', function(){ return ++$this->index; })
                // ->addColumn('name', function($row){
                //     $rowDetails = '<div class="row-option">';
                //     $rowDetails .= '<span>' . $row->name . '</span>';
                //     $rowDetails .= '<div class="button-group mt-2">';
                //     $rowDetails .= '<a href="' . route('group.edit', $row->id ) . '">Edit</a> | ';
                //     $rowDetails .= '<a href="#">Delete</a>';
                //     $rowDetails .= '</div>';
                //     $rowDetails .= '</div>';
                //     return $rowDetails;
                // })
                ->addColumn('year', function($row){ return $row->year; })
                ->addColumn('month', function($row){ return month_name($row->month); })
                ->addColumn('day', function($row){ return $row->day; })
                ->addColumn('total_amount', function($row){ return $row->total_amount; })
                // ->addColumn('members', function($group) {
                //     $members = '';
                //     foreach ($group->members as $member) {
                //         if (!empty($member[0])) {
                //             $members .= ucfirst($member[0]) . ', ';
                //         }
                //     }
                //     return rtrim($members, ', ');
                // })
                // ->rawColumns(['name'])
                ->make(true);
        }else{
            return DataTables::of([])->make(true);
        }

    }
}
