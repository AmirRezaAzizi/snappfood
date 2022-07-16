<?php

namespace Modules\Base\Exceptions;

use Exception;
use Modules\Base\Traits\ApiResponse;

class CustomException extends Exception
{
    use ApiResponse;

    /**
     * Render the exception into an HTTP response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(): \Illuminate\Http\JsonResponse
    {
        return $this->error($this->getMessage(), $this->getCode());
    }
}
