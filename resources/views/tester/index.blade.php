@extends('layouts.app')

@section('title', 'API Tester')

@section('content')
<div class="row">
    <h3 class="pink-text text-lighten-1">API Tester</h3>
    <div class="col s10 offset-s1 m8 offset-m2">
        @include('tester.partial._form')
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
