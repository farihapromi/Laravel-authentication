<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;

class SuperAdminController extends Controller
{
    //
    public function reviewPost(Post $post)
    {
        if (Auth::user()->isSuperAdmin()) {
            // Approve or reject post based on super-admin's decision
            $post->status = 'approved'; // or 'rejected'
            $post->save();
            return redirect()->back()->with('success', 'Post status updated successfully');
            // Redirect or return response
        } else {
            return redirect()->back()->with('error', 'Unauthorized action');
            // Redirect or show unauthorized message
        }
    }
}
