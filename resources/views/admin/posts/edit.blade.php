@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>
<form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class='container  col-8 offset-2 '>



        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" id="title" name="title" value="{{ $post->title }}">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content:</label>
            <textarea id="content" name="content">{{ $post->content }}</textarea>
        </div>
        <button type="submit " class='btn btn-success'>Update Post</button>
    </div>
</form>
@endsection