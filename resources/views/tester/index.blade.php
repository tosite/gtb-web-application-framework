@extends('layouts.app')

@section('title', 'API Tester')

@section('content')
<div class="row">
    <div class="col s12">
        <h3>Routes</h3>
        <div class="card blue-grey darken-2">
            <div class="card-content white-text" style="overflow-x: scroll">
                <pre><code class="code green-text text-lighten-2">{{ $route }}</code></pre>
            </div>
        </div>
    </div>
</div>

@endsection
