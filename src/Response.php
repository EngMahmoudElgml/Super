<?php

namespace EngMahmoudElgml\Super;

class Response
{
    public function defaultResponse($status, $error_code, $validation, $message, $response, $token = NULL)
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
