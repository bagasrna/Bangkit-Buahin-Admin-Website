<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e) {
            if ($e instanceof NotFoundHttpException) {
                if ($e->getPrevious() instanceof ModelNotFoundException) {
                    return $this->errorResponse('Data not found with ID provided', 'NOT_FOUND', 404);
                }
                Log::error($e->getMessage() . ' => ' . $e->getFile() . ':' . $e->getLine());
                return $this->errorResponse('Url not found', 'NOT_FOUND', 404);
            } else if ($e instanceof MethodNotAllowedHttpException) {
                Log::error($e->getMessage() . ' => ' . $e->getFile() . ':' . $e->getLine());
                return $this->errorResponse('Method not allowed', 'INVALID_ACTION', 405);
            } else if ($e instanceof UnauthorizedException) {
                Log::error($e->getMessage() . ' => ' . $e->getFile() . ':' . $e->getLine());
                return $this->errorResponse('You don\'t have access', 'UNAUTHORIZED', 401);
            } else if ($e instanceof AccessDeniedHttpException) {
                Log::error($e->getMessage() . ' => ' . $e->getFile() . ':' . $e->getLine());
                return $this->errorResponse('You don\'t have access', 'UNAUTHORIZED', 401);
            } else {
                Log::error($e->getMessage() . ' => ' . $e->getFile() . ':' . $e->getLine());
                // return $this->errorResponse('Internal server error', 'SERVER_ERROR', 500);
            }
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof HamaException) {
            return redirect()->route('hama.index')->with('error', json_decode($e->getMessage(), true));
        } else if ($e instanceof PenyakitException) {
            return redirect()->route('penyakit.index')->with('error', json_decode($e->getMessage(), true));
        } else if ($e instanceof GulmaException) {
            return redirect()->route('gulma.index')->with('error', json_decode($e->getMessage(), true));
        }

        return parent::render($request, $e);
    }
}
