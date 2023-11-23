@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>
<form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $post->title }}">
    </div>
    <div>
        <label for="content">Content:</label>
        <textarea id="content" name="content">{{ $post->content }}</textarea>
    </div>
    <button type="submit">Update Post</button>
</form>
@endsection