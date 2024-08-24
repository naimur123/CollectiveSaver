<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /* Login View*/
    public function loginForm(Request $request){
        // session()->flush();
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
        session()->flush();
        $response = send_request('post', $url, $data);
        if(!empty($response) && !empty($response->status)){
            set_data('token', $response->access_token);
            $data =  $response->data;
            set_data('user_id', $data->id);
            set_data('user_name', $data->name);
            set_data('user_data', $data);
            set_alert('success', $response->message);
            return redirect()->route('home');
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

    /* Dashboard */
    public function dashboard(Request $request){
        $data = get_data('user_data');
        if(!empty($data)){
            $params = [
                'data' => $data
            ];
            return view('user.dashboard.home', $params);
        }else{
            set_alert('warning', 'Session Out');
            return redirect('logout');
        }

    }

    /* Logout */
    public function logout(Request $request){
        $url = 'https://collectivesaverapi.naimur.com.bd/api/v1/logout';
        $token = get_data('token');
        if(!empty($token)){
            $response = send_request('post', $url, '', $token);
            if(!empty($response) && !empty($response->status)){
                session()->flush();
                set_alert('success', $response->message);
                return redirect('login');
            }
            else{
                set_alert('warning', $response->message);
                return back();
            }
        }
        else{
            set_alert('warning', 'Operation Failed');
            return back();
        }

    }


}
