@extends('layouts.app', ['title' => 'Browse Streams from Twitch, Youtube and Mixer',
'description' => 'Cross-platform live steams browser. View streams from Twitch, Youtube and Mixer in one place.'])

@section('content')

    <div class="columns is-multiline is-centered">
        <div class="column is-10 popular-games">
            <h1 class="popular-games__header">Popular Games</h1>
            <div class="columns is-multiline is-centered popular is-mobile">
                @foreach ($populars as $popular)
                    <div class="column is-2-tablet is-6-mobile popular-games__column">
                        <a href="/game/{{$popular['name']}}">
                            <div class="card">
                                <div class="card-image">
                                    <figure class="image is-128x128-mobile">
                                        <img class="popular__img"
                                             src="{{$popular['image']}}"
                                             alt="Placeholder image">
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <div class="content">
                                        <p class="popular__title">{{ $popular['name'] }}</p>
                                        <span style="color: white"><i class="far fa-eye"></i></span>
                                        <p class="popular__viewers"> {{ $popular['viewers'] }} </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="column is-10 streams">
            <div id="example">
            </div>
            {{--            <div class="columns is-multiline stream">--}}
            {{--                @foreach ($streams as $stream)--}}
            {{--                    <div class="column is-3">--}}
            {{--                        <a target="_blank"--}}
            {{--                           href="{{ $stream['url'] }}">--}}
            {{--                            <div class="card">--}}
            {{--                                <div class="card-image">--}}
            {{--                                    <figure class="image is-352x198">--}}
            {{--                                        <img class="stream__img"--}}
            {{--                                             src="{{ $stream['preview'] }}"--}}
            {{--                                             alt="Placeholder image">--}}
            {{--                                    </figure>--}}
            {{--                                </div>--}}
            {{--                                <div class="card-content">--}}
            {{--                                    <div class="media">--}}
            {{--                                        <div class="media-left">--}}
            {{--                                            <figure class="image is-48x48">--}}
            {{--                                                <img class="is-rounded"--}}
            {{--                                                     src="{{ $stream['logo']}}"--}}
            {{--                                                     alt="Placeholder image">--}}
            {{--                                            </figure>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="media-content">--}}
            {{--                                            <p class="stream__channel">{{ $stream['user'] }}</p>--}}

            {{--                                            <span style="color: white"><i class="far fa-eye"></i></span>--}}
            {{--                                            <p class="stream__viewers">{{ $stream['viewers'] }}</p>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}

            {{--                                    <div class="content">--}}
            {{--                                        <p class="stream__title">{{ $stream['title'] }}</p>--}}
            {{--                                        <a href="/game/{{$stream['game']}}"--}}
            {{--                                           class="stream__game">{{ $stream['game'] }}</a>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </a>--}}
            {{--                    </div>--}}
            {{--                @endforeach--}}
            {{--            </div>--}}
        </div>
    </div>

@endsection