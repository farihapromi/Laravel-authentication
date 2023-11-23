<!-- resources/views/auth-options.blade.php -->
@extends('layouts.app')

@section('content')

@if (Auth::guest())
<div class="flex">
    <a href="{{ route('login') }}"
        class="px-4 py-2 rounded-md bg-blue-500 text-white font-semibold hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Log
        in</a>

    @if (Route::has('register'))
    <a href="{{ route('register') }}"
        class="ml-4 px-4 py-2 rounded-md bg-green-500 text-white font-semibold hover:bg-green-600 focus:outline-none focus:bg-green-600">Register</a>
    @endif
</div>
@else
<!-- Other authenticated user content or options -->
<!-- For example: -->
<!-- <a href="{{ route('logout') }}">Logout</a> -->
@endif