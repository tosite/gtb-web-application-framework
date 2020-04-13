<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesterController extends Controller
{

    public function index()
    {
        $route = $this->getRoute();
        return view('tester/index', ['route' => $route]);
    }

    public function exec(Request $request)
    {
        $route = $this->getRoute();
        $action = $request->input('action');
        $uri = $request->input('uri');
        $url = request()->getSchemeAndHttpHost() . (empty($uri) ? '' : $uri);
        $params = $request->input('params');
        $res = $this->getCurlResponse($action, $url, $params);
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

    private function getRoute()
    {
        \Artisan::call('route:list');
        return\Artisan::Output();
    }

    private function getCurlResponse($method, $url = '', $params = '')
    {
        $command = $this->getCommand($method, $url, $params);
        return ['command' => $command, 'curl' => $this->execCurl($command)];
    }

    private function getCommand($method, $url, $params)
    {
        $command = "curl {$url}";
        if ($method === 'get') {
            return $command;
        }

        $command .= ' -X' . strtoupper($method);
        if (empty($params) || $method === 'delete') {
            return $command;
        }
        return "{$command} -d {$params}";
    }

    private function execCurl($command)
    {
        exec($command . ' -I', $header);
        exec($command, $result);
        return ['header' => $header, 'result' => $result];
    }
}
