<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;

class SuperAdminController extends Controller
{



    public function showSubmittedPosts()
    {
        $submittedPosts = Post::where('status', 'pending_superadmin')->get();
        return view('superadmin.posts', ['submittedPosts' => $submittedPosts]);
    }

    public function reviewPost(Request $request, Post $post)
    {
        if ($request->action === 'approve') {
            $post->status = 'approved';
            $post->save();
            return redirect()->back()->with('success', 'Post approved successfully');
        } elseif ($request->action === 'reject') {
            $post->status = 'rejected';
            $post->save();
            return redirect()->back()->with('success', 'Post rejected');
        }
    }


}





