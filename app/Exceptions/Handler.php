<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    // ...

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException) {
            // Si l'exception est une AuthorizationException, retournez la vue 403 standard
            return response()->view('errors.403', [], 403);
        }

        if ($exception instanceof HttpException && $exception->getStatusCode() == 403) {
            // Vérifiez si l'URL a expiré pour la vérification du mail
            if ($request->is('email/verify*') && $exception->getMessage() == 'Invalid signature.') {
                return response()->view('errors.email-expired', [], 403);
            }

            // Autres contextes spécifiques pour 403
            return response()->view('errors.custom-403', [], 403);
        }

        return parent::render($request, $exception);
    }
}
