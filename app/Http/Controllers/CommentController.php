<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return [
            ['id' => 1, 'name' => 'yamada', 'content' => 'hello'],
            ['id' => 2, 'name' => 'tanaka', 'content' => 'world'],
        ];
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return ['id' => 2, 'name' => 'tanaka', 'content' => 'world'];
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
