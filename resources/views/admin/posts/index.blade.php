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

<a href="{{ route('admin.posts.create') }}">Create New Post</a>

<table border="1">
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
            <td>{{ $post->status }}</td>
            <td>
                <a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a> |
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection