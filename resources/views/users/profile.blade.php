@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profiel van {{ $user->name }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="text-center">

                            @auth
                                @if (Auth::id() === $user->id)
                                    <h3>{{ __('Welcome, :name', ['name' => Auth::user()->name]) }}</h3>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="profile-image">
                                                @if (Auth::user()->profile_image)
                                                    <img src="{{ asset(Auth::user()->profile_image) }}" alt="Profile Image"
                                                        style="width: 200px; height: auto;">
                                                @else
                                                    <p>No profile image available.</p>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="profile_image">{{ __('Profile Image') }}</label>
                                                <input type="file" name="profile_image" id="profile_image"
                                                    class="form-control-file">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 offset-md-6">
                                            <p>{{ __('Email: :email', ['email' => Auth::user()->email]) }}</p>
                                            <p>{{ __('Birthday: :birthday', ['birthday' => Auth::user()->birthday]) }}</p>
                                            <p>{{ __('Short About Me: :about_me', ['about_me' => Auth::user()->about_me]) }}</p>

                                        </div>
                                    </div>

                                    <form action="{{ route('editProfile') }}" method="PUT" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')



                                        <br><br>
                                        <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
                                    </form>
                                @endif
                            @endauth

                            <hr>
                            <hr>
                            <br>

                            <h2>Gemaakte Posts</h2>
                            @foreach ($user->posts as $post)
                                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a><br>
                                {{ $post->message }}
                            @endforeach

                            <hr>
                            <h2>Gelikete Posts</h2>
                            @foreach ($user->likes as $like)
                                <a href="{{ route('posts.show', $like->post_id) }}">{{ $like->post->title }}</a><br>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
