@extends('layouts.app', ['title' => 'News from live streaming world',
'description' => 'Read latest news from live streaming world.'])

@section('content')
    <div class="columns is-mobile is-variable is-5 is-multiline is-centered streams">
        <div class="column is-2 news__sidebar is-hidden-touch">
            <div class="columns is-multiline is-centered stream is-hidden-touch">
                @for ($i = 0; $i < 3; $i++)
                    <div class="column is-12">
                        <a target="_blank"
                           href="{{ $streams[$i]['url'] }}">
                            <div class="card">
                                <div class="card-image">
                                    <figure class="image is-352x198">
                                        <img class="stream__img"
                                             src="{{ $streams[$i]['preview'] }}"
                                             alt="live stream preview image">
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <div class="media">
                                        <div class="media-left">
                                            <figure class="image is-48x48">
                                                <img class="is-rounded"
                                                     src="{{ $streams[$i]['logo']}}"
                                                     alt="live streamer avatar">
                                            </figure>
                                        </div>
                                        <div class="media-content">
                                            <p class="stream__channel">{{ $streams[$i]['user'] }}</p>

                                            <span style="color: white"><i class="far fa-eye"></i></span>
                                            <p class="stream__viewers">{{ $streams[$i]['viewers'] }}</p>
                                        </div>
                                    </div>

                                    <div class="content">
                                        <p class="stream__title">{{ $streams[$i]['title'] }}</p>
                                        <a href="/game/{{$streams[$i]['game']}}"
                                           class="stream__game">{{ $streams[$i]['game'] }}</a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endfor
            </div>
        </div>

        <div class="column is-11-tablet is-5-desktop is-10-mobile  news">
            <h1 class="news__header">Browse News from Streaming world!</h1>
            <div class="columns is-centered is-mobile is-multiline">
                @foreach ($posts as $post)
                    <div class="column is-12-tablet is-12-desktop is-12-mobile news__box">
                        <a href="/news/{{$post->slug}}">

                            <div class="columns is-multiline">
                                <div class="column is-8 is-relative">
                                    <p class="news__title">{{$post->title}}</p>
                                    <p class="news__author">{{$post->author['name']}} | {{$post->created_at}}</p>
                                </div>
                                <div class="column is-4 is-relative">
                                     <span class="news__helper"></span><img class="news__img" src="{{ Voyager::image( $post->image ) }}" alt="news image">
                                </div>

                            </div>
                        </a>

                    </div>
                @endforeach
                {{ $posts->links() }}
            </div>
        </div>
        <div class="column is-2 news__sidebar is-hidden-touch">
            <div class="columns is-multiline stream is-hidden-touch">
                @for ($i = 3; $i < 6; $i++)
                    <div class="column is-12">
                        <a target="_blank"
                           href="{{ $streams[$i]['url'] }}">
                            <div class="card">
                                <div class="card-image">
                                    <figure class="image is-352x198">
                                        <img class="stream__img"
                                             src="{{ $streams[$i]['preview'] }}"
                                             alt="live stream preview image">
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <div class="media">
                                        <div class="media-left">
                                            <figure class="image is-48x48">
                                                <img class="is-rounded"
                                                     src="{{ $streams[$i]['logo']}}"
                                                     alt="live streamer avatar">
                                            </figure>
                                        </div>
                                        <div class="media-content">
                                            <p class="stream__channel">{{ $streams[$i]['user'] }}</p>

                                            <span style="color: white"><i class="far fa-eye"></i></span>
                                            <p class="stream__viewers">{{ $streams[$i]['viewers'] }}</p>
                                        </div>
                                    </div>

                                    <div class="content">
                                        <p class="stream__title">{{ $streams[$i]['title'] }}</p>
                                        <a href="/game/{{$streams[$i]['game']}}"
                                           class="stream__game">{{ $streams[$i]['game'] }}</a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </div>


@endsection