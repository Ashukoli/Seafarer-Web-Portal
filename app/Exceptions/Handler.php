<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * The list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Handle unauthenticated users (session expired or not logged in).
     *
     * The base ExceptionHandler expects a Symfony Response-compatible return.
     * We return either a JsonResponse (for API/AJAX) or a RedirectResponse for web.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // If the client expects JSON (AJAX/API), return JSON response
        if ($request->expectsJson()) {
            // Using response()->json makes it explicit and recognized by static analysers
            return response()->json(['message' => $exception->getMessage() ?: 'Unauthenticated.'], 401);
        }

        // Determine guard to redirect to the correct login page
        $guard = $exception->guards()[0] ?? null;

        switch ($guard) {
            case 'admin':
                $loginRoute = route('admin.login.form', [], false);
                break;
            case 'candidate':
                $loginRoute = route('candidate.login.form', [], false);
                break;
            default:
                // Fallback: try generic 'login' route; if not available use candidate login page
                if (app('router')->has('login')) {
                    $loginRoute = route('login', [], false);
                } else {
                    $loginRoute = route('candidate.login.form', [], false);
                }
                break;
        }

        return redirect()->guest($loginRoute);
    }
}
