<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class BlogPostController extends Controller
{
    public function index()
    {
        return response()->json(BlogPost::orderBy('post_date', 'desc')->get());
    }

    public function show($id)
    {
        $post = BlogPost::find($id);
        if ($post) {
            return response()->json($post);
        }
        return response()->json(['message' => 'Post not found'], 404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'foodtype' => 'required',
            'desc' => 'required',
            'image' => 'nullable|string',
            'image2' => 'nullable|string',
        ]);

        $post = BlogPost::create([
            'post_title' => $validated['title'],
            'post_category' => $validated['category'],
            'foodtype' => $validated['foodtype'],
            'post_description' => $validated['desc'],
            'post_image' => $validated['image'] ?? '',
            'post_image2' => $validated['image2'] ?? '',
            'post_date' => now()->format('Y-m-d H:i:s'),
        ]);

        return response()->json(['message' => 'Post created', 'post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $post = BlogPost::find($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'foodtype' => 'required',
            'desc' => 'required',
            'image' => 'nullable|string',
            'image2' => 'nullable|string',
        ]);

        $post->update([
            'post_title' => $validated['title'],
            'post_category' => $validated['category'],
            'foodtype' => $validated['foodtype'],
            'post_description' => $validated['desc'],
            'post_image' => $validated['image'] ?? $post->post_image,
            'post_image2' => $validated['image2'] ?? $post->post_image2,
        ]);

        return response()->json(['message' => 'Post updated', 'post' => $post]);
    }

    public function destroy($id)
    {
        $post = BlogPost::find($id);
        if ($post) {
            $post->delete();
            return response()->json(['message' => 'Post deleted']);
        }
        return response()->json(['message' => 'Post not found'], 404);
    }
}
