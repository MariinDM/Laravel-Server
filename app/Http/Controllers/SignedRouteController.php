<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignedRouteController extends Controller
{
    public function SignedRoute(Request $request)
    {
        // verificar la firma de la URL
        if (!$request->hasValidSignature()) {
            abort(403, 'URL no válida o expirada');
        }

        return view('code-web');
    }
}
