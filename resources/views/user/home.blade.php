@extends('layouts.app')

@section('content')
<h1 style="text-align: center; color: green;">Welcome to User Home Page</h1>



@if ($approvedPosts->isEmpty())
<p>No approved posts yet.</p>
@else
<table class="table" style="border: 1px solid #ccc; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="border: 1px solid black; padding: 8px; 
            color: white; background-color: teal;">Title</th>
            <th style="border: 1px solid black; padding: 8px; 
            color: white;  background-color: teal;">Content</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($approvedPosts as $post)
        @if ($post->status === 'approved')
        <tr>
            <td style="border: 2px solid black; padding: 8px; color: Black;">{{ $post->title }}</td>
            <td style="border: 2px solid black; padding: 8px; color: Black;">{{ $post->content }}</td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
@endif
@endsection