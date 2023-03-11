<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignedRouteController extends Controller
{
    public function SignedRoute(Request $request)
    {
        // verificar la firma de la URL
        if (!$request->hasValidSignature()) {
            abort(403, 'URL no válida o expirada');
        }

        $num = random_int(1000, 9999);

        $user = Auth::user();

        $code = Code::create([
            'code' => Hash::make($num),
            'active' => true,
            'user_id' => $user->id,
        ]);

        $code->save();

        return view('code-web', ['data' => $num]);
    }
}
