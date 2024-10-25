<?php

use App\Application\Exceptions\ValidationException;
use App\Application\Middlewares\Headers;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: app_path('Interfaces/Http/Routes/routes.php'),
        health: '/up',
        apiPrefix: ''
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api([
            Headers::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) {
            return response()->json([
                'message' => __('Bad method')
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        });
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return response()->json([
                'message' => __('Not found')
            ], Response::HTTP_NOT_FOUND);
        });
        $exceptions->render(function (ModelNotFoundException $e, Request $request) {
            return response()->json([
                'message' => __('Not found')
            ], Response::HTTP_NOT_FOUND);
        });
        $exceptions->render(function (ThrottleRequestsException $e, Request $request) {
            return response()->json([
                'seconds' => $e->getHeaders()['Retry-After'],
                'message' => __('Maximum attempts, please try again later')
            ], Response::HTTP_TOO_MANY_REQUESTS);
        });
        $exceptions->render(function (AuthorizationException $e, Request $request) {
            return response()->json([
                'message' => __('Forbidden')
            ], Response::HTTP_FORBIDDEN);
        });
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return response()->json([
                'message' => __('Unauthorized')
            ], Response::HTTP_UNAUTHORIZED);
        });
        $exceptions->render(function (ValidationException $e, Request $request) {
            return response()->json([
                'message' => __('Validation exception'),
                'errors' => $e->getErrors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        });
    })->create();
