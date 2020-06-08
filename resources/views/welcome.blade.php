@extends('layouts.app')

@section('css')
    <style>
        main {
            margin-top: 3rem;
        }

        .header {
            margin: 0 auto;
            width: 80%;
            text-align: center;
        }

        .title {
            font-size: 4rem;
        }

        .tagline {
            font-size: 1.5rem;
        }

        .main-body {
            background-color: white;
            /*border: 1px solid black;*/
            width: 90%;
            margin: 0 auto;
            padding: 2rem;
        }

        .section {
            width: 70%;
            margin: 0 auto;
            /*text-align: center;*/
        }

    </style>
@endsection

@section('content')
<main>
    <div class="header">
        <h1 class="title">Nano News</h1>
        <hr>
        <p class="tagline">
            The news you care about, and only the news you care about.
            <br>
            No massive feeds, no unwanted content.
            <br>
            Exactly what you ask for, everytime.
        </p>
        <a href="/register" class="btn btn-lg btn-primary">Get Started</a>
    </div>
    <br>
    <br>
    <div class="main-body">
        <section class="section">
            <h2 class="s-head">What?</h2>
            <p class="s-content">
                Nano News is a news aggregator. We take your specific key word searches and scour news outlets,
                high and low, for content. The content is algorithmically sorted down into the most up to date, interesting,
                and relevant results. News is sourced from a variety of networks, allowing you to enjoy varied and
                diverse content.
            </p>
        </section>
        <br>
        <section class="section">
            <h2 class="s-head">How?</h2>
            <p class="s-content">
                Simply <a href="/register">sign up</a>, add some feeds, and enjoy the results! Feeds are pulled from
                content published in the last 24 hours to ensure freshness and are updated every 12 hours.
                Depending upon your search, the results may seem lacking. We have some tips regarding that on the
                submission page, so be sure to read over those before adding a new feed.
            </p>
        </section>
        <br>
        <section class="section">
            <h2 class="s-head">Questions? Feedback? Bugs?</h2>
            <p class="s-content">
                Please fill out the form below if you have any questions, feedback, bug reports, or any other reason
                to want to contact me! I'd very much appreciate hearing whatever it is you have to say.
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/feedback" method="POST" class="d-flex flex-column">
                    @csrf
                    <input name="email" type="email" placeholder="Your Email" required>
                    <br>
                    <textarea name="comment"cols="30" rows="10" placeholder="Your Comment" required></textarea>
                    <br>
                    <button type="submit" class="btn btn-md btn-success">Send</button>
                </form>
            <p/>
        </section>
    </div>
</main>
@endsection
