<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MiddlewareRegisterController extends Controller
{
    public function registerRoleMiddleware()
    {
        // Register the RoleMiddleware in the kernel
        Artisan::call('make:middleware', [
            'name' => 'RoleMiddleware'
        ]);
    }
}
