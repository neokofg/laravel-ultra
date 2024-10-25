<?php

use Symfony\Component\HttpFoundation\Response;

/**
 * @param mixed $data
 * @param string $message
 * @param int $code
 * @return array
 */
function qck_response(mixed $data = true, string $message = 'Success', int $code = Response::HTTP_OK): array
{
    return [
        [
            $data,
            'message' => __($message),
        ],
        $code
    ];
}
