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

    public function exec(Request $request)
    {
        \Artisan::call('route:list');
        $route = \Artisan::Output();
        $action = $request->input('action');
        $uri = $request->input('uri');
        $params = $request->input('params');
        $res = $this->execCurl($action, $uri, $params);
        return view('tester/index', [
            'route'   => $route,
            'header'  => implode(PHP_EOL, $res['curl']['header']),
            'result'  => implode(PHP_EOL, $res['curl']['result']),
            'method'  => $action,
            'uri'     => $uri,
            'params'  => $params,
            'command' => $res['command'],
        ]);
    }

    private function execCurl($method, $uri = '', $params = '')
    {
        $command = 'curl ' . request()->getSchemeAndHttpHost() . (empty($uri) ? '': $uri);
        if ($method === 'get') {
            return ['command' => $command, 'curl' => $this->_exec($command)];
        }

        $command .= ' -X' . strtoupper($method);
        if (empty($params) || $method === 'delete') {
            return ['command' => $command, 'curl' => $this->_exec($command)];
        }
        $command = "{$command} -d {$params}";
        return ['command' => $command, 'curl' => $this->_exec($command)];
    }

    private function _exec($command)
    {
        exec($command . ' -I', $header);
        exec($command, $result);
        return ['header' => $header, 'result' => $result];
    }
}
