<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesterController extends Controller
{

    public function index()
    {
        $route = $this->getRoute();
        return view('tester/index', [
            'route'  => $route,
            'method' => '',
            'uri'    => '',
            'params' => '',
        ]);
    }

    public function exec(Request $request)
    {
        $route = $this->getRoute();
        $action = $request->input('action');
        $uri = $request->input('uri');
        $url = request()->getSchemeAndHttpHost() . (empty($uri) ? '' : $uri);
        $params = $request->input('params');
        $res = $this->getCurlResponse($action, $url, $params);
        $response = json_decode(implode(PHP_EOL, $res['curl']['response']));
        return view('tester/index', [
            'route'   => $route,
            'curl'    => implode(PHP_EOL, $res['curl']['header']),
            'json'    => json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT),
            'method'  => $action,
            'uri'     => $uri,
            'params'  => $params,
            'command' => $res['command'],
        ]);
    }

    private function getRoute()
    {
        \Artisan::call('route:list');
        return \Artisan::Output();
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
        return "{$command} -d '{$params}'";
    }

    private function execCurl($command)
    {
        exec($command . ' -i', $header);
        exec($command, $response);
        return ['header' => $header, 'response' => $response];
    }
}
