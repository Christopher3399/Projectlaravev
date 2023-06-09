<!-- resources/views/faq/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New FAQ</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('faq.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="question" class="col-md-4 col-form-label text-md-end">Question</label>

                                <div class="col-md-6">
                                    <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question') }}" required autofocus>

                                    @error('question')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="answer" class="col-md-4 col-form-label text-md-end">Answer</label>

                                <div class="col-md-6">
                                    <textarea id="answer" class="form-control @error('answer') is-invalid @enderror" name="answer" required>{{ old('answer') }}</textarea>

                                    @error('answer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Add FAQ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
