@extends('layouts.app')

@section('css')
    <style>
        html {
            scroll-behavior: smooth;
        }

        main {
            padding-top: 2rem;
        }

        .feed-list {
            list-style: none;
            display: grid;
            gap: 2rem;
            grid-template-columns: repeat(auto-fit, minmax(24px, 1fr));
            margin: 2.5% auto;
            width: 50%;
            border: 1px black solid;
            background-color: white;
            padding: 2rem;
        }

        .section-title {
            text-align: center;
        }

        .u-card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            height: 500px;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.25);
            border-radius: 15px 15px 15px 15px ;
            align-items: center;
            padding-top: 1rem;
            text-overflow: ellipsis;
            transition-duration: .5s;
        }

        .u-card:hover {
            /*border-radius: 0 10% 0 10%;*/
            /*background-color: lightgray;*/
            border: 2px solid rgba(0, 0, 0, 0.5);
            border-radius: 0;
        }

        .u-card-body {
            display: inline-block;
            word-break: break-word;
            word-wrap: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 1rem;
        }

        .u-card-img {
            /*border-radius: 10px;*/
            width: 50%;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }

        .u-card-link {
            color: black;
        }

        .u-card-link:hover {
            text-decoration: none;
            color: black;
        }

        .u-card-title {
            padding: 1rem;
            font-size: 1rem;
        }

        .u-container {
            padding: 2rem;
            display: grid;
            gap: 2rem;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            /*grid-auto-rows: 10px;*/
        }

        hr {
            width: 100%;
            margin-top: .1rem;
        }

        .no-feeds {
            text-align: center;
            background: white;
            box-shadow: 3px 3px 10px 1px lightgray ;
            width: 90vw;
            padding: 1rem 0 1rem 0;
            border-radius: 20px;
            margin: 3rem auto;
        }

        .no-feeds > a {
            width: 30%;
        }

        .no-feeds > p {
            font-size: 1.25rem;
        }
    </style>
@endsection

@section('content')
    @if(empty($responses))
        <div class="no-feeds" style="padding: 5%;">
            <p>You haven't created any Feeds! Add some, it's easy.</p>
            <a href="/feeds" class="btn btn-md btn-success">Go</a>
        </div>
    @else
        <div class="no-feeds">
            <p>Add/Delete Feeds</p>
            <a href="/feeds" class="btn btn-md btn-success">Go</a>
        </div>
        <ul class="feed-list">
            GOTO:
            @foreach($responses as $term => $res)
                <a href={{'#'.$term}}><li>{{ $term }}</li></a>
            @endforeach
        </ul>
        @foreach($responses as $term => $res)
            <section id="{{$term}}">
                <h2 class="section-title">Results for: "{{ $term }}"</h2>
                <div class="u-container">
                    @foreach($res->value as $val)
                        <a href="{{ $val->url }}"class="u-card-link">
                            <div class="u-card">
                                <div class="u-card-title">
                                    <h4>{{ $val->name }}</h4>
                                </div>
                                <hr>
                                <img class="u-card-img" src="{{ $val->image->thumbnail->contentUrl ?? '/imgs/launch.svg'}}" alt="article image">

                                <div class="u-card-body">
                                    {{ $val->description }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endforeach
    @endif
@endsection

