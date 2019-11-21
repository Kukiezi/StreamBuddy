@extends('layouts.app', ['title' => 'Browse Streams from Twitch, Youtube and Mixer',
'description' => 'Cross-platform live steams browser. View streams from Twitch, Youtube and Mixer in one place.'])

@section('content')
    <div class="column is-12" style="padding: 0">
        <div class="columns is-multiline " style="margin-right: 0; margin-left: 0">
            @include('navbar.sidebar', ['topTwitch' => $topTwitch, 'topMixer' => $topMixer, 'topYoutube' => $topYoutube])
            @include('navbar.sidebarsmall', ['topTwitch' => $topTwitch, 'topMixer' => $topMixer, 'topYoutube' => $topYoutube])
            <div class="column">
                <div class="columns is-multiline is-centered react-streams">
                    <div class="column is-11 streams streams__game">
                        <div class="columns is-mobile is-multiline is-centered ">
                            <div class="column is-12 is-relative">
                                <img class="game__image" src="{{$game['image']}}" alt="image of chosen game"/>
                                <h1 class="streams__game-header">{{$game['name']}}</h1>
                                {{--                    <p class="streams__game-viewers">{{$game['viewers']}}</p>--}}
                                <span class="streams__game-viewers">
                    <span style="color: white"><i class="far fa-eye"></i></span>
                    <p class="stream__viewers">{{ isset($game['viewers']) ?  $game['viewers'] : $viewers}}</p></span>
                            </div>
                        </div>
                        <div class="columns is-multiline stream is-mobile is-centered">
                            @foreach ($streams as $stream)
                                <div class="column is-4-tablet is-3-desktop is-11-mobile">
                                    <a href="/stream/{{$stream['platform']}}/{{$stream['user']}}">
                                        <div class="card is-relative">
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
                                                             src="{{asset('images/twitch.png')}}"
                                                             alt="twitch logo icon"/>
                                                    </figure>
                                                @elseif ($stream['platform'] == 'mixer')
                                                    <figure class="image is-24x24 streams__mixer--absolute">
                                                        <img class="streams__mixer--absolute"
                                                             src="{{asset('images/mixerdark.png')}}"
                                                             alt="twitch logo icon"/>
                                                    </figure>

                                                @elseif ($stream['platform'] == 'youtube')
                                                    <figure class="image is-24x24 streams__mixer--absolute">
                                                        <img class="streams__mixer--absolute"
                                                             src="{{asset('images/youtube3.png')}}"
                                                             alt="twitch logo icon"/>
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
                                                    <p class="stream__game">{{ $stream['game'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection