<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function testGetApi()
    {
        return response()->json(['answer' => 'Привет!']);
    }
    public function testPostApi(Request $request): \Illuminate\Http\JsonResponse
    {
        $var = $request->all();
        $password = Hash::make($var['password']);

        $cook = $_COOKIE;

        $var['Hash'] = $password;
        $var['cook'] = $cook;
        return response()->json($var);
    }
}
