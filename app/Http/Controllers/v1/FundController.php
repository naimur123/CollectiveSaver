<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FundController extends Controller
{
    /* Get Table Column List */
    private function getColumns(){
        $columns = ['#', 'group_identifi', 'group_name', 'year', 'month', 'day', 'total_amount'];
        return $columns;
    }

    /* Get DataTable Column List */
    private function getDataTableColumns(){
        $columns = ['#', 'group_identifi', 'group_name', 'year', 'month', 'day', 'total_amount'];
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
        $user_groups = '';
        $group_fund_data = '';
        if(!empty($token)){
            if(!empty($request->fund_id)){
                $fund_data = [
                    'id' => $request->fund_id
                ];
                $url = 'https://collectivesaverapi.naimur.com.bd/api/v1/fund';
                $fund = send_request('post', $url, $fund_data , $token);
                if(!empty($fund) && !empty($fund->status)){
                    $group_fund_data = $fund->data;
                }
            }

            $url = 'https://collectivesaverapi.naimur.com.bd/api/v1/groups';
            $response = send_request('get', $url, '', $token);

            if(!empty($response) && !empty($response->status)){
                $user_groups = $response->data->user_groups;
            }
        }

        $params = [
           'title' => 'Group Fund Create',
           'data' => $data,
           'user_groups' => $user_groups,
           'group_fund_data' => $group_fund_data,
           'form_url' => route('group.fund.store'),
           'group_fund_individual' => route('group_fund_individual')
        ];
        return view('funds.create', $params);
    }

    /* Group Fund Store */
    public function store(Request $request){
        $fund_info_array = json_decode($request->fund_info, true);
        $fund_info_data = [];

        foreach ($fund_info_array as $info) {
            if (!is_null($info[0])) {
                $fund_info_data[] = [
                    'name' => $info[0],
                    'amount' => $info[1],
                    'transferred_from' => $info[2],
                ];
            }
        }
        $fund_info_json = json_encode($fund_info_data);
        $data = [
            'id' => !empty($request->id) ? $request->id : '',
            'group_id' => $request->group_id,
            'fund_info' => $fund_info_json
        ];
        $token = get_data('token');
        $url = 'https://collectivesaverapi.naimur.com.bd/api/v1/store_fund';

        if(!empty($token)){
            $response = send_request('post', $url, $data, $token);
            if(!empty($response) && !empty($response->status)){
                set_alert('success', $response->message);
                return redirect('group_fund');
            }
        }else{
            set_alert('warning', 'Token missmatch');
            return back();
        }
    }

    /* Individual group fund */
    public function group_fund_individual(Request $request){
        if(!empty($request->id)){
            $token = get_data('token');
            $url = 'https://collectivesaverapi.naimur.com.bd/api/v1/groups/' . $request->id;

            if(!empty($token)){
                $response = send_request('get', $url, '', $token);
                if(!empty($response)){
                    $members_name = [];
                    $group_members = $response->data->members;
                    foreach($group_members as $group_member){
                        if(!empty($group_member[0])){
                            $members_name[] = $group_member[0];
                        }
                    }
                    // return $members_name;
                    return response()->json([
                        'members_name' => $members_name
                    ]);

                }
            }
        }
    }


    /* Get Datatable value */
    public function getDataTable($user_groups_funds){

        if(!empty($user_groups_funds)){
            return DataTables::of($user_groups_funds)
                ->addColumn('#', function(){ return ++$this->index; })
                ->addColumn('group_identifi', function($row){
                    $rowDetails = '<div class="row-option">';
                    $rowDetails .= '<span>' . $row->group_info->group_identifications . '</span>';
                    $rowDetails .= '<div class="button-group mt-2">';
                    $rowDetails .= '<a href="' . route('group.fund.edit', $row->id) . '">Edit</a>';
                    $rowDetails .= '</div>';
                    $rowDetails .= '</div>';
                    return $rowDetails;
                })
                ->addColumn('group_name', function($row){ return $row->group_info->name; })
                ->addColumn('year', function($row){ return $row->year; })
                ->addColumn('month', function($row){ return month_name($row->month); })
                ->addColumn('day', function($row){ return $row->day; })
                ->addColumn('total_amount', function($row){ return $row->total_amount; })
                ->rawColumns(['group_identifi'])
                ->make(true);
        }else{
            return DataTables::of([])->make(true);
        }

    }
}
