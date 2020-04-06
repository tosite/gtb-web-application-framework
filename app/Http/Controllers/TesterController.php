<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesterController extends Controller
{

    public function index()
    {
        \Artisan::call('route:list');
        $route = \Artisan::Output();
        return view('tester/index', ['route' => $route]);
    }

    public function get(Request $request)
    {
        //
    }

    public function post(Request $request)
    {
        //
    }

    public function put(Request $request)
    {
        //
    }

    public function delete(Request $request)
    {
        //
    }
}
