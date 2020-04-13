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
        return view('tester/index', [
            'route'   => $route,
            'curl'    => implode(PHP_EOL, $res['curl']),
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
        $br = PHP_EOL;
        exec($command . ' -i', $header);
        return str_replace('[', "[{$br}  ",
            str_replace(']', "{$br}]",
                str_replace('},', "},{$br}  ", $header)
            )
        );
    }
}
