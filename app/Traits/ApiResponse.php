<?php


namespace App\Traits;


trait ApiResponse
{
    /**
     * Return a success JSON response.
     *
     * @param array $data
     * @param string|null $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success(array $data = [], string $message = null, int $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message ?? 'OK',
            'data' => $data
        ], $code);
    }

    /**
     * Return an error JSON response.
     *
     * @param string $message
     * @param int $code
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error(string $message, int $code, array $data = []): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'data' => $data
        ], $code);
    }

}
