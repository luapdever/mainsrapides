<?php

use \Vonage\Client\Credentials\Basic;
use \Vonage\Client;
use \Vonage\SMS\Message\SMS;

function send_sms(String $to, String $brand, String $body) {
    try {
        $basic  = new Basic("94b7ee63", "pajlFB8JmcTGST0Y");
        $client = new Client($basic);

        $response = $client->sms()->send(
            new SMS($to, $brand, $body)
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        return false;
    }
}

function confirm_number($user) {
    $code = random_int(10000, 99999);

    $message = "" . get_full_name($user) . ", votre code de confirmation est " . $code;

    $res = send_sms($user["telephone"], "MAINSRAPIDES CODE", $message);

    if($res) {
        return $code;
    } else {
        return null;
    }
}



?>