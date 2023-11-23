<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;

class SuperAdminController extends Controller
{
    //
    // public function reviewPost(Post $post)
    // {
    //     if (Auth::user()->isSuperAdmin()) {
    //         // Fetch the post and check its status
    //         $post = Post::findOrFail($post->id);

    //         if ($post->status === 'pending_superadmin') {
    //             // Approve the post
    //             $post->status = 'approved';
    //             $post->save();
    //             return redirect()->route('superadmin.posts')->with('success', 'Post approved successfully');
    //         } else {
    //             // Reject the post or handle as needed
    //             $post->status = 'rejected';
    //             $post->save();
    //             return redirect()->route('superadmin.posts')->with('error', 'Post rejected');
    //         }
    //     } else {
    //         return redirect()->route('user.home')->with('error', 'You are not authorized as a super-admin');
    //     }
    // }

    // public function showAdminPosts()
    // {
    //     $adminPosts = Post::where('status', 'pending_superadmin')->get();
    //     return view('superadmin.posts', ['adminPosts' => $adminPosts]);
    // }

    // public function showApprovedPostsToUsers()
    // {
    //     $approvedPosts = Post::where('status', 'approved')->get();
    //     return view('user.home', ['approvedPosts' => $approvedPosts]);
    // }


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





