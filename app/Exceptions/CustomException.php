<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return response()->json([
            'error' => $this->getMessage()
        ], $this->getCode());
    }
}
