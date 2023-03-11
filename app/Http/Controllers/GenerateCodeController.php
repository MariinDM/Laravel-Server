<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class GenerateCodeController extends Controller
{
    public function storeMovil(Request $request)
    {
        $code_mobil = $request->code;

        $codes = Code::where('active', true)->get();

        foreach ($codes as $code) {
            if (Hash::check($code_mobil, $code->code)) {

                $code->active = false;

                $code->save();

                $num = random_int(1000, 9999);

                Code::create([
                    'code' => Hash::make($num),
                    'active' => true,
                    'user_id' => $code->user_id,
                ]);

                return response()->json($num, 200);
            }
        }
        return response()->json('Codigo No Valido', 400);
    }
    public function storeWeb(Request $request)
    {
        $code_web = $request->code;

        $codes = Code::where('active', true)->get();

        foreach ($codes as $code) {
            if (Hash::check($code_web, $code->code)) {

                $code->active = false;

                $code->save();

                Cookie::queue('code', $code_web);

                return redirect('dashboard');
            }
        }
        return response()->json('Codigo No Valido', 400);
    }
}
