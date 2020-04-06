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
        \Artisan::call('route:list');
        $route = \Artisan::Output();
        $res = $this->execCurl($request->input('action'),$request->input('params'));
        return view('tester/index', ['route' => $route, 'result' => implode(PHP_EOL, $res)]);
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

    private function execCurl($method, $params)
    {
        $command = 'curl ' . request()->getSchemeAndHttpHost();
        $result = [];
        if ($method === 'get') {
            exec($command, $result);
            return $result;
        }

        $command .= ' -X' . strtoupper($method);
        if (empty($params) ||$method === 'delete') {
            exec($command, $result);
            return $result;
        }
        exec("{$command} -d {$params}", $result);
        return $result;
    }
}
