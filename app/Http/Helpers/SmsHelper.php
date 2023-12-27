<?php

namespace App\Http\Helpers;

class SmsHelper{
    public static function send($to,$message){
      
        $data = array(
            'username' => env('AFRICAS_TALKING_USERNAME'),
            'to' => $to,
            'message' => $message,
        );

        $curl = curl_init('https://api.africastalking.com/version1/messaging');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
            'apiKey: ' . env('AFRICAS_TALKING_API_KEY')
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        if ($response !== false) {
            echo $response;
        } else {
            echo 'Error: ' . curl_error($curl);
        }
    }
}