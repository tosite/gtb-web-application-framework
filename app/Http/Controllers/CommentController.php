<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::all();
    }

    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->fill($request->input())->save();
        return response()->json($comment, 201);
    }

    public function show($id)
    {
        return Comment::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->fill($request->input())->save();
        return response()->json($comment, 200);
    }

    public function destroy($id)
    {
        return response()->noContent();
    }
}
