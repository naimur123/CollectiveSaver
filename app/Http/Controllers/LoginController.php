<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    /* Login View*/
    public function loginForm(Request $request){
        return view('login');
    }

    /* Login */
    public function login(Request $request){
        $response = Http::post('https://collectivesaverapi.naimur.com.bd/api/v1/login', [
            'phone' => $request->phone,
            'password' => $request->password,
        ]);

        echo $response;
    }

}
