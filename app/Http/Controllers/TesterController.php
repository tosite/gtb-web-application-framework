<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesterController extends Controller
{

    public function index()
    {
        return view('tester/index', [
            'method' => '',
            'uri'    => '',
            'params' => '',
        ]);
    }

    public function exec(Request $request)
    {
        $params = $this->params($request->input());
        $action = $request->input('action');
        $uri = $request->input('uri');
        $url = request()->getSchemeAndHttpHost() . (empty($uri) ? '' : $uri);
        $res = $this->getCurlResponse($action, $url, $params);
        $response = json_decode( $res['curl']['response']);
        return view('tester/index', [
            'curl'    => implode(PHP_EOL, $res['curl']['header']),
            'json'    => json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT),
            'method'  => $action,
            'uri'     => $uri,
            'params'  => $request->input(),
            'command' => $res['command'],
        ]);
    }

    private function params($input)
    {
        if (!array_key_exists('key', $input)) {
            return '';
        }
        $strParam = '';
        foreach ($input['key'] as $i => $key) {
            $value = $input['value'][$i];
            if (!empty($key) && !empty($value)) {
                $strParam .= "{$key}={$value}&";
            }
        }
        if (strlen($strParam) !== 0) {
            $strParam = substr($strParam, 0, -1);
        }
        return $strParam;
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
        $response = $header[count($header) - 1];
        return ['header' => $header, 'response' => $response];
    }
}
