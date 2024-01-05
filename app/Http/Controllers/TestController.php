<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testGetApi()
    {
        return 'Проверка Api';
    }
    public function testPostApi(Request $request)
    {
        $var = $request->all();
        $var['test3'] = 'Ответ Api';
        return $var;
    }
}
