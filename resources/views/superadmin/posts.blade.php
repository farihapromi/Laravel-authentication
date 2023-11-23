@extends('layouts.app')

@section('content')
<h1>Submitted Posts for Super-Admin Review</h1>

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
                        <th>Title</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submittedPosts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->status }}</td>
                        <td>
                            <form
                                action="{{ route('superadmin.posts.review', ['post' => $post->id, 'action' => 'approve']) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <form
                                action="{{ route('superadmin.posts.review', ['post' => $post->id, 'action' => 'reject']) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection