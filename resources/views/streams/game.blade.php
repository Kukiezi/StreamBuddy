@extends('layouts.app', ['title' => 'Browse Streams from Twitch, Youtube and Mixer',
'description' => 'Cross-platform live steams browser. View streams from Twitch, Youtube and Mixer in one place.'])

@section('content')
    <div class="columns is-multiline is-centered">

        <div class="column is-10 streams streams__game">
            <div class="columns">
                <div class="column is-10 is-relative">
                    <img class="game__image" src="{{$game['image']}}" alt="image of chosen game"/>
                    <h1 class="streams__game-header">{{$game['name']}}</h1>
                    {{--                    <p class="streams__game-viewers">{{$game['viewers']}}</p>--}}
                    <span class="streams__game-viewers">
                    <span style="color: white"><i class="far fa-eye"></i></span>
                    <p class="stream__viewers">{{ isset($game['viewers']) ?  $game['viewers'] : $viewers}}</p></span>
                </div>
            </div>
            <div class="columns is-multiline stream">
                @foreach ($streams as $stream)
                    <div class="column is-3">
                        <a target="_blank"
                           href="{{ $stream['url'] }}">
                            <div class="card">
                                <div class="card-image">
                                    <figure class="image is-352x198">
                                        <img class="stream__img"
                                             src="{{ $stream['preview'] }}"
                                             alt="live stream preview image">
                                    </figure>
                                </div>
                                <div class="card-content is-relative">
                                    @if ($stream['platform'] == 'twitch')
                                        <figure class="image is-24x24 streams__mixer--absolute">
                                            <img class="streams__mixer--absolute"
                                                 src="{{asset('images/twitch.png')}}" alt="twitch logo icon"/>
                                        </figure>
                                    @elseif ($stream['platform'] == 'mixer')
                                        <figure class="image is-24x24 streams__mixer--absolute">
                                            <img class="streams__mixer--absolute"
                                                 src="{{asset('images/mixerdark.png')}}" alt="twitch logo icon"/>
                                        </figure>

                                    @elseif ($stream['platform'] == 'youtube')
                                        <figure class="image is-24x24 streams__mixer--absolute">
                                            <img class="streams__mixer--absolute"
                                                 src="{{asset('images/youtube3.png')}}" alt="twitch logo icon"/>
                                        </figure>
                                    @endif
                                    <div class="media">
                                        <div class="media-left">
                                            <figure class="image is-48x48">
                                                <img class="is-rounded"
                                                     src="{{ $stream['logo']}}"
                                                     alt="live streamer avatar">
                                            </figure>
                                        </div>
                                        <div class="media-content">
                                            <p class="stream__channel">{{ $stream['user'] }}</p>

                                            <span style="color: white"><i class="far fa-eye"></i></span>
                                            <p class="stream__viewers">{{ $stream['viewers'] }}</p>
                                        </div>
                                    </div>

                                    <div class="content">
                                        <p class="stream__title">{{ $stream['title'] }}</p>
                                        <a href="/game/{{$stream['game']}}"
                                           class="stream__game">{{ $stream['game'] }}</a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection