@extends('layouts.app')

@section('content')
<h1 style='text-align: center; color: green;'>Welcome To SuperAdmin Page</h1>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; padding: 8px; 
            color: white; background-color: teal;">Title</th>
                        <th style="border: 1px solid black; padding: 8px; 
            color: white; background-color: teal;">Content</th>
                        <th style="border: 1px solid black; padding: 8px; 
            color: white; background-color: teal;">Status</th>
                        <th style="border: 1px solid black; padding: 8px; 
            color: white; background-color: teal;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submittedPosts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->status }}</td>
                        <td>
                            <div>


                                <form
                                    action="{{ route('superadmin.posts.review', ['post' => $post->id, 'action' => 'approve']) }}"
                                    method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                                <form
                                    action="{{ route('superadmin.posts.review', ['post' => $post->id, 'action' => 'reject']) }}"
                                    method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection