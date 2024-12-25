<?php

namespace App\Utils;

class Util
{
    public static function getSuccessMessage($message, $data = null)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public static function getSuccessMessageWithToken($message, $data = null, $token = null)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'token' => $token
        ], 200);
    }

    public static function getErrorMessage($message, $data = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data
        ], 400);
    }
}
