@extends('layouts.app')

@section('css')
    <style>
        .text-input {
            border-radius: 20px;
            border: 1px gray solid;
        }

        .feed-tips {
            padding: 1rem;
            margin-top: 4rem;
            border-top: #2a9055 2px solid;
            border-bottom: #2a9055 2px solid;
            border-radius: 20px;
        }

        .tips-list {
            /*list-style: none;*/
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="feed-tips">
                    <h1 class="lead">Here are some useful tips:</h1>
                    <ul class="tips-list">
                        <li>
                            <p>
                                Be specific when adding key words. Instead of broad topics like "Technology"
                                try more specific queries like "Quantum Computing". Even better,
                                try to pick specific companies, people, or entities. The less specific the the query,
                                the less relevant results you'll get.
                            </p>
                        </li>
                        <li>
                            <p>
                                Results are pulled from the past 24 hours and are updated twice per day.
                                We analyze and return the top 10 most relevant ones. There may be times where
                                there are not 10 results, or the 10 results we are able to return are not especially relevant.
                                We are always trying to improve, but it will never be perfect.
                            </p>
                        </li>
                        <li>
                            <p>
                                Finally, have fun! If there are any issues please reach out to us and we'll do our best
                                to address them. Thank you!
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="card" style="margin-top: 4rem;">
                    <div class="card-header">{{ __('New Feed') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('new_feed') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="terms" class="col-md-4 col-form-label text-md-right">{{ __('Add feeds:') }}</label>

                                <div class="col-md-6">
                                    <input id="term" type="text" class="form-control" name="term" placeholder="Enter word, term, or phrase here" autofocus required>
                                </div>
                            </div>
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            @error('term')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="d-flex justify-content-center pt-4 pb-0">
                    <button class="btn btn-lg btn-success">View Feeds</button>
                </div>
                <div class="card" style="margin-top: 2rem;">
                    <div class="card-header">{{ __('Current Feeds') }}</div>

                    <div class="card-body">
                        @if((Auth::user()->feeds->isEmpty()))
                            Empty!
                        @else
                            @foreach($feeds as $feed)
                                <div class="d-flex justify-content-between">
                                    <p>{{ $feed->term }}</p>
                                    <form action="/feeds/{{$feed->term}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button style="width:100%; margin-bottom: 0; border-radius: 10px"
                                                class="d-inline btn btn-danger"
                                                id="btn-override"
                                                type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                                <hr>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
