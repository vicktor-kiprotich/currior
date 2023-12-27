<?php

namespace App\Http\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
// use Itsmurumba\Mpesa\Mpesa;
use Starnerz\LaravelDaraja\Requests\STK;

class MpesaHelper extends Controller
{
    private $consumerKey;
    private $consumerSecret;
    private $tokenUrl = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    private $c2bUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    private $mpesa;

    public function __construct()
    {
        $this->c2bUrl= \App\BusinessSetting::where('type', 'daraja_sandbox')->first()->value == 1?'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest':'https://api.safaricom.co.ke/mpesa/stkpush/v1/processre;quest';
        $this->tokenUrl= \App\BusinessSetting::where('type', 'daraja_sandbox')->first()->value == 1?'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials':'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $this->consumerKey = env('DARAJA_CONSUMER_KEY');
        $this->consumerSecret = env('DARAJA_CONSUMER_SECRET');
    }

    public function simulate()
    {
        \App\Payment::query()->create([
            'status' => 0,
            'shipment_id' => 2,
            'payment_method' => 'MPESA',
            'txn_code' => bin2hex(random_bytes(10)),
            'amount' => 0,

        ]);
        
        $this->stkPush('0748004573', 1, 'AW9848901', 'iuhnf9qhfewoiheowhfoew');
    }

    public function stkPush($phone, $amount, $shippingAddress, $callbackCode)
    {
        $phone = $this->formatPhone($phone);
        try {
            $curl_Tranfer2 = curl_init();
            $token = $this->getAuthToken();
            curl_setopt($curl_Tranfer2, CURLOPT_URL, $this->c2bUrl);
            curl_setopt($curl_Tranfer2, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $token));

            $curl_Tranfer2_post_data = [
                'BusinessShortCode' => 174379,
                'Password' => 'MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjMwNzMwMTg0MjE1',
                'Timestamp' => '20230730184215',
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => 254708374149,
                'PartyB' => 174379,
                'PhoneNumber' => $phone,
                'CallBackURL' => env('APP_DEBUG') == true ? 'https://webhook.site/bd061572-a3b0-425b-b1de-e413d24de6ea' : env('APP_URL') . 'daraja-callback/' . $callbackCode,
                'AccountReference' => 'EXPRESSLINE',
                'TransactionDesc' => "Payment of {$shippingAddress}"
            ];

            $data2_string = json_encode($curl_Tranfer2_post_data);

            curl_setopt($curl_Tranfer2, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_Tranfer2, CURLOPT_POST, true);
            curl_setopt($curl_Tranfer2, CURLOPT_POSTFIELDS, $data2_string);
            curl_setopt($curl_Tranfer2, CURLOPT_HEADER, false);
            curl_setopt($curl_Tranfer2, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl_Tranfer2, CURLOPT_SSL_VERIFYHOST, 0);
            $curl_Tranfer2_response = json_decode(curl_exec($curl_Tranfer2));

            flash('STK push sent.')->success();
            return;
        } catch (\Exception $e) {
            flash('Failed, please try again later.')->success();
            return;
        }
    }

    private function formatPhone($phoneNumber)
    {
        $cleanedNumber = preg_replace('/\D/', '', $phoneNumber);
        $cleanedNumber = str_replace(' ', '', $cleanedNumber);
        if (strpos($cleanedNumber, '0') === 0) {
            $formattedNumber = '254' . substr($cleanedNumber, 1);
        } else {
            $formattedNumber = $cleanedNumber;
        }

        return $formattedNumber;
    }

    private function getAuthToken()
    {
        $credentials = base64_encode($this->consumerKey . ':' . $this->consumerSecret);
        $ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . $credentials]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $token = json_decode($response)->access_token;
        return $token;
    }
}