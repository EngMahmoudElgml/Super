<?php

namespace EngMahmoudElgml\Super\Traits;

use Image;
use File;
use Mail;

trait SuperTrait
{

    public function generatePassword($size = 8)
    {
        $p = openssl_random_pseudo_bytes(ceil($size * 0.67), $crypto_strong);
        $p = str_replace('=', '', base64_encode($p));
        $p = strtr($p, '+/', '^*');
        return substr($p, 0, $size);
    }

    public function generateOrderId($size)
    {
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
            . '0123456789'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, $size) as $k) $rand .= $seed[$k];
        return $rand;
    }
   public function generatePin($size)
    {
        $seed = str_split('0123456789'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, $size) as $k) $rand .= $seed[$k];
        return $rand;
    }

    public function generatePromo($size)
    {
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
            . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            . '0123456789'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, $size) as $k) $rand .= $seed[$k];
        return $rand;
    }



    public function randomPin()
    {
        return rand(1111, 9999);
    }


    public function jsonResponse($status, $error_code, $validation, $message, $response, $token = NULL)
    {
        if (is_array($response)) {
            if (count($response) == 0) {
                $response = new \stdClass();
            }
        }


        return response()->json([
            'status' => $status,
            'token' => $token,
            'code' => $error_code,
            'validation' => $validation,
            'message' => $message,
            'data' => $response,
        ], $error_code);
    }

}
