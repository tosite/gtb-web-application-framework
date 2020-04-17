<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function index()
    {
        return [
            ['name' => 'tom', 'content' => 'hello'],
            ['name' => 'sam', 'content' => 'world'],
        ];
    }

    public function store(\App\Http\Requests\Comments\Post $request)
    {
    }

    public function show($id)
    {
    }

    public function update(\App\Http\Requests\Comments\Put $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
