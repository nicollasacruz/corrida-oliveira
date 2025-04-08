<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        '/api/token',
        'api/*', // <- pega todas as rotas api/
        '/api/*',
    ];

}
