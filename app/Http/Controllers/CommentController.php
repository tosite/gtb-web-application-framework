<?php

namespace App\Http\Controllers;

use App\Comment;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::all();
    }

    public function store(\App\Http\Requests\Comments\Post $request)
    {
        $comment = new Comment();
        $comment->fill($request->input())->save();
        return response()->json($comment, 201);
    }

    public function show($id)
    {
        return Comment::findOrFail($id);
    }

    public function update(\App\Http\Requests\Comments\Put $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->fill($request->input())->save();
        return response()->json($comment, 200);
    }

    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        return response()->noContent();
    }
}
