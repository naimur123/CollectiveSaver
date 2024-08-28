<?php

/* Send HTTP GET/POST request */

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

if(!function_exists('send_request()')){
    function send_request($type = '', $url = '', $data = '', $token = ''){

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
        ];

        if(!empty($token)){
            $headers[] = 'Authorization: Bearer ' . $token;
        }

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if(!empty($type) && $type == 'post'){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        else{
            curl_setopt($ch, CURLOPT_HTTPGET, true);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        curl_close($ch);

        if (isset($error_msg)) {
            return response()->json(['error' => $error_msg], 500);
        }

        return json_decode($response);
    }
}

/* Get alert Message */
if(!function_exists('set_alert()')){
    function set_alert($type = '', $message = ''){
        clear_alert($type);
        session()->flash($type, $message);
    }
}

/* Clear alert */
if(!function_exists('clear_alert()')){
    function clear_alert($type = '') {
        session()->forget($type);
    }
}

/* Get user Name/ID */
if(!function_exists('get_data()')){
    function get_data($key){
       return session()->get($key);
    }
}

/* Set Session */
if(!function_exists('set_data()')){
    function set_data($key = '', $value = ''){
       if(!session()->exists($key)){
          Session::put($key, $value);
       }
       else{
          session()->forget($key);
          set_data($key, $value);
       }
    }
}

/* Set Session */
if(!function_exists('month_name()')){
    function month_name($value = '', $format = ''){
        $monthname = '';
        if(empty($format)){
           $monthname = Carbon::createFromFormat('m', $value)->format('F');
        }
        return $monthname;
    }
}

