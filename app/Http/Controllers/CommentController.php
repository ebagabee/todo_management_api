<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::with('task')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'content' => 'required|string',
        ]);

        return Comment::create($request->all());
    }

    public function show(Comment $comment)
    {
        return $comment->load('task');
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->update($request->all());
        return $comment;
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(null, 204);
    }
}
