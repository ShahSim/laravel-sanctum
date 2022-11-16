<?php

namespace App\Traits;

/**
 * Trait for Http responses
 */
trait HttpResponses
{
    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Request successfull',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($data = null, $message = null, $code)
    {
        return response()->json([
            'status' => 'Eoor has occured',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function unauthorized()
    {
        return $this->error(null, 'Action unauthorized', 401);
    }
}
