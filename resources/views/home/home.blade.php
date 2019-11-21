@extends('layouts.app', ['title' => 'Browse Streams from Twitch, Youtube and Mixer',
'description' => 'Cross-platform live steams browser. Browser, follow and watch live streams from Twitch, Youtube and Mixer in one place. Use StreamBuddy to achieve next level of user experience in streaming world!'])

@section('content')

    <div class="column is-12" style="padding: 0">
        <div class="columns is-multiline" style="margin-right: 0; margin-left: 0">
            @include('navbar.sidebar', ['topTwitch' => $topTwitch, 'topMixer' => $topMixer, 'topYoutube' => $topYoutube])
            @include('navbar.sidebarsmall', ['topTwitch' => $topTwitch, 'topMixer' => $topMixer, 'topYoutube' => $topYoutube])
               <div class="column " id="example"
                                 data-user="{{ Auth::user() != null ? Auth::user()->id : ''}}">
                            </div>
{{--            <div class="column popular-games">--}}
{{--                <div class="columns is-multiline is-centered">--}}
{{--                    <div class="column is-11">--}}
{{--                        <h1 class="popular-games__header">Popular Games</h1>--}}
{{--                        <div class="columns is-multiline is-centered popular is-mobile">--}}
{{--                            @foreach ($populars as $popular)--}}
{{--                                <div class="column is-2-tablet is-6-mobile popular-games__column">--}}
{{--                                    <a href="/game/{{$popular['name']}}">--}}
{{--                                        <div class="card">--}}
{{--                                            <div class="card-image">--}}
{{--                                                <figure class="image is-128x128-mobile">--}}
{{--                                                    <img class="popular__img"--}}
{{--                                                         src="{{$popular['image']}}"--}}
{{--                                                         alt="Placeholder image">--}}
{{--                                                </figure>--}}
{{--                                            </div>--}}
{{--                                            <div class="card-content">--}}
{{--                                                <div class="content">--}}
{{--                                                    <p class="popular__title">{{ $popular['name'] }}</p>--}}
{{--                                                    <span style="color: white"><i class="far fa-eye"></i></span>--}}
{{--                                                    <p class="popular__viewers"> {{ $popular['viewers'] }} </p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                            <div class="column is-12" id="example"--}}
{{--                                 data-user="{{ Auth::user() != null ? Auth::user()->id : ''}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>

@endsection
