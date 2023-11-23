@extends('layouts.app')

@section('content')
<h1>Admin Posts</h1>

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
        <div class="col-8 offset-2">
            <a href="{{ route('admin.posts.create') }}">Create New Post</a>
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->content }}</td>
                            <td>
                                @if($post->status === 'pending_superadmin')
                                Pending Super-Admin Review
                                @elseif($post->status === 'approved')
                                Approved
                                @elseif($post->status === 'rejected')
                                Rejected
                                @else
                                Pending
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                </form>
                                <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                                @if($post->status === 'pending' || $post->status === 'rejected')
                                <form action="{{ route('admin.posts.submitForReview', ['post' => $post->id]) }}"
                                    method="POST" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">Submit</button>
                                </form>



                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection