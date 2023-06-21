@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Alle posts') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach ($posts as $post)
                            <h3><a href="{{route('posts.show', $post->id)}}">{{ $post->title }}</a></h3>
                            {{ $post->message }} <br>
                            <small>gepost door <a href="{{ route('profile', $post->user->name ) }}">{{ $post->user->name }} </a>op
                                {{ $post->created_at->format('d/m/y \o\m H:i') }}</small>
                            @Auth
                                @if ($post->user_id == Auth::user()->id)
                                    <a href="{{ route('posts.edit', $post->id) }}"> Edit</a><br>
                                @else
                                    <a href="{{route('like', $post->id)}}"> Like post</a>
                                @endif
                                <br>
                            @endauth
                            Post heeft {{ $post->likes()->count() }} likes

                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
