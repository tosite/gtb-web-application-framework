@extends('layouts.app')

@section('title', 'API Tester')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/styles/atelier-sulphurpool-dark.min.css">
<style>
    .code {
        font-family: "Courier New", Consolas, monospace;
    }

    #tab-tester .tabs-content .carousel .carousel-slider {
        height: 80vh;
    }
</style>
@endsection

@section('content')
<ul id="tabs" class="tabs">
    <li class="tab col s3"><a href="#swipe-1" class="active">API</a></li>
    <li class="tab col s3"><a href="#swipe-2">Route</a></li>
</ul>
<div id="tab-tester" style="padding: 10px;">
    <div id="swipe-1" class="col s12">
        <div class="row">
            <div class="col s5">
                <h4 class="pink-text text-lighten-1">API Tester</h4>
                @include('tester.partial._form')
            </div>

            <div class="col s7">
                <h4 class="pink-text text-lighten-1">Result</h4>
                @if (!empty($curl))
                <div class="card" style="background: #202746;">
                    <div class="card-content white-text pt-0 bp-0" style="overflow-x: scroll">
                        <pre><code class="code sh"># {{ $method }}{{ PHP_EOL }}{{ $command }}{{ PHP_EOL }}{{ $curl }}@if (!empty($repsonse)) {{ $response }} @endif</code></pre>
                        @if (!empty($json) && $json !== 'null')
                        <pre><code class="code sh">{{ $json }}</code></pre>
                        @endif
                    </div>
                </div>
                @else
                <div class="card yellow lighten-2">
                    <div class="card-content amber-text text-darken-2">
                        No response.
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div id="swipe-2" class="col s12">
        <div class="row">
            <div class="col s12">
                <h4 class="pink-text text-lighten-1">Routes</h4>
                <div class="card" style="background: #202746;">
                    <div class="card-content white-text pt-0 bp-0" style="overflow-x: scroll">
                        <pre><code class="code plaintext green-text text-lighten-2">{{ $route }}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();
  const el = document.getElementById('tabs');
  const instance = M.Tabs.init(el);</script>
@endsection
