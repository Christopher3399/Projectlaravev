<!-- resources/views/faq/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('FAQ') }}</div>

                    <div class="card-body">
                        <!-- Affichage des FAQs -->
                        @foreach ($faqs as $faq)
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3>{{ $faq->question }}</h3>
                                    <p>{{ $faq->answer }}</p>
                                </div>
                                <div>
                                    @auth
                                        @if (Auth::user()->is_admin)
                                            <a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-primary mr-2">Edit</a>
                                            <form action="{{ route('faq.destroy', $faq->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
