<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;

class AdminPostController extends Controller
{
    public function create()
    {
        return view('admin.posts.create');
    }
    public function index()
    {
        $posts = Post::all(); // Fetch all posts. You might want to paginate them if there are many.
        return view('admin.posts.index', ['posts' => $posts]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = new Post();
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->user_id = Auth::id();
        $post->status = 'pending'; // Set status to 'pending' for review
        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully and submitted for review');
    }

    public function edit(Post $post)
    {
        if ($post->user_id === Auth::id()) {
            return view('admin.posts.edit', compact('post'));
        } else {
            return redirect()->route('admin.posts.index')->with('error', 'Unauthorized action');
        }
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id === Auth::id()) {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
            ]);

            $post->title = $validatedData['title'];
            $post->content = $validatedData['content'];
            $post->save();

            return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully');
        } else {
            return redirect()->route('admin.posts.index')->with('error', 'Unauthorized action');
        }
    }

    public function destroy(Post $post)
    {
        if ($post->user_id === Auth::id()) {
            $post->delete();

            return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully');
        } else {
            return redirect()->route('admin.posts.index')->with('error', 'Unauthorized action');
        }
    }

    public function submitForReview(Post $post)
    {
        if ($post->user_id === Auth::id()) {
            $post->status = 'pending';
            $post->save();

            return redirect()->route('admin.posts.index')->with('success', 'Post submitted for review');
        } else {
            return redirect()->route('admin.posts.index')->with('error', 'Unauthorized action');
        }
    }
}
