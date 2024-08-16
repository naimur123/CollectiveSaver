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
        if(!empty($response) && !empty($response->status)){
            Session::put('token', $response->access_token);
            $data =  $response->data;
            Session::put('user_id', $data->id);
            Session::put('user_name', $data->name);
            set_alert('success', 'Loggedin Successfully');
            return redirect()->route('home')->with('data', $data);
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
        $params = [
            'data' => $request->data
        ];
        // dd(session()->all());
        return view('user.dashboard.home', $params);
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
