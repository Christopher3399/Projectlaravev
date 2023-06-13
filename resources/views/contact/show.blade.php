<!-- show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Message </h1>

            <div class="mb-3">
                <strong>Name:</strong> {{ $message->name }}
            </div>

            <div class="mb-3">
                <strong>Email:</strong> {{ $message->email }}
            </div>

            <div class="mb-3">
                <strong>Message:</strong> {{ $message->message }}
            </div>
            <hr>

    </div>
@endsection
