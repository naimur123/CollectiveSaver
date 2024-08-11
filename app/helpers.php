<?php

/* Send HTTP GET/POST request */

use Brian2694\Toastr\Facades\Toastr;

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
        // session()->flash($type, $message);
        if($type == 'success'){
            Toastr::success($message);
        }else if($type == 'warning'){
            Toastr::warning($message);
        }else if($type == 'info'){
            Toastr::info($message);
        }else{
            Toastr::error($message);
        }
    }
}

/* Get user Name/ID */
if(!function_exists('get_data()')){
    function get_data($key){
       return session()->get($key);
    }
}

