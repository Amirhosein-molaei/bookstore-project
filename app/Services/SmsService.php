<?php

namespace App\Services;

use SoapClient;
use SoapFault;

class SmsService{
    private $username;
    private $password;
    private $from;

    public function __construct()
    {
        $this->username = config('sms.username');
        $this->password = config('sms.password');
        $this->from = config('sms.from');
    }

    public function sendOtpSms($phoneNumber, $otpCode)
    {
        try {
            $client = new SoapClient('https://api.payamak-panel.com/post/Send.asmx?wsdl', ['encoding' => 'UTF-8']);
            $parameters = [
                'username' => $this->username,
                'password' => $this->password,
                'to' => $phoneNumber,
                'from' => $this->from,
                'text' => 'کد تایید شما: ' . $otpCode,
                'isflash' => false
            ];

            $result = $client->SendSimpleSms2($parameters);

            if (isset($result->SimpleSms2Result)) {
                $responseCode = $result->SimpleSms2Result;

                if ($responseCode == '0') {
                    return true;
                } else {
                    throw new \Exception('Error in sending sms.');
                }
            }
        } catch (SoapFault $e) {
            throw new \Exception('Error in sending sms: ' . $e->getMessage());
        }
    }
}