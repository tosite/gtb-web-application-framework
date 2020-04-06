@extends('layouts.app')

@section('title', 'API Tester')

@section('content')
<div class="row">
    <div class="col s5">
        <h3 class="pink-text text-lighten-1">API Tester</h3>
        @include('tester.partial._form')
    </div>

    <div class="col s7">
        <h3 class="pink-text text-lighten-1">Result</h3>
        @if (!empty($result))
        <div class="card blue-grey darken-2">
            <div class="card-content white-text" style="overflow-x: scroll">
                <pre><code class="code green-grey"># {{ $method }}{{ PHP_EOL }}{{ $command }}</code></pre>
            </div>
        </div>

        <div class="card blue-grey darken-2">
            <div class="card-content white-text" style="overflow-x: scroll">
                <pre><code class="code green-text text-lighten-2">{{ $result }}</code></pre>
            </div>
        </div>
        @endif
    </div>

    <div class="col s12">
        <h3 class="pink-text text-lighten-1">Routes</h3>
        <div class="card blue-grey darken-2">
            <div class="card-content white-text" style="overflow-x: scroll">
                <pre><code class="code green-text text-lighten-2">{{ $route }}</code></pre>
            </div>
        </div>
    </div>
</div>

@endsection
