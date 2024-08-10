<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /* Login View*/
    public function loginForm(Request $request){
        $params = [
            'tab' => 'login'
        ];
        return view('login', $params);
    }

    /* Login */
    public function login(Request $request){
        $url = 'https://collectivesaverapi.naimur.com.bd/api/v1/login';
        $data = [
            'phone' => $request->phone,
            'password' => $request->password,
        ];

        $response = send_request('post', $url, $data);
        if(!empty($response)){
            Session::put('token', $response->access_token);
            $data =  $response->data;
            Session::put('user_id', $data->id);
            $params = [
                'data' => $data
            ];
            set_alert('success', $response->message);
            return view('user.dashboard.home', $params);
        }
        else{
            set_alert('warning', $response->message);
            return back();
        }
    }

    /* Register View*/
    public function registerForm(Request $request){
        $params = [
            'tab' => 'register'
        ];
        return view('login', $params);
    }

    /* Register */
    public function register(Request $request){
        $url = 'https://collectivesaverapi.naimur.com.bd/api/v1/register';
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => $request->password,
        ];

        $response = send_request('post', $url, $data);
        return $response;
    }

}
