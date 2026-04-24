<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index($postId)
    {
        $comments = DB::table('comment as c')
            ->join('user as u', 'c.user_id', '=', 'u.user_id')
            ->where('c.post_id', $postId)
            ->select('c.comment_id', 'c.comment_text', 'c.created_at', 'u.user_name')
            ->orderBy('c.created_at', 'desc')
            ->get();
            
        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:blogpost,post_id',
            'user_id' => 'required|exists:user,user_id',
            'commenttext' => 'required|string',
        ]);

        $comment = Comment::create([
            'post_id' => $validated['post_id'],
            'user_id' => $validated['user_id'],
            'comment_text' => $validated['commenttext'],
            'created_at' => now()->format('Y-m-d H:i:s'),
        ]);

        return response()->json(['message' => 'Comment created', 'comment' => $comment]);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->delete();
            return response()->json(['message' => 'Comment deleted']);
        }
        return response()->json(['message' => 'Comment not found'], 404);
    }
}
