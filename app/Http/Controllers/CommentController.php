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
        return response()->json(['id' => 3, 'name' => 'sato', 'content' => '!!'], 201);
    }

    public function show($id)
    {
        return ['id' => 2, 'name' => 'tanaka', 'content' => 'world'];
    }

    public function update(Request $request, $id)
    {
        return response()->json(['id' => 2, 'name' => 'tanako', 'content' => 'word!'], 200);
    }

    public function destroy($id)
    {
        return response()->noContent();
    }
}
