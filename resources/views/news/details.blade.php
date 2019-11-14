@extends('layouts.app', ['title' => $post['title'],
'description' => $post['meta_description']])
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
@section('content')
    <div class="columns is-mobile is-multiline is-centered streams">
        <div class="column is-2 is-hidden-touch">
            <div class="columns is-multiline stream">
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
        <div class="column is-4-desktop is-10-tablet is-11-mobile news-details">
            <div class="button__back--box">
                <a href="{{ url()->previous() }}" class="button__back"><span class="color-mixer"><i
                                class="fas fa-long-arrow-alt-left"></i></span> <span class="color-twitch">Go back to news</span>
                    <span class="color-mixer">buddy</span></a>
            </div>
            <img class="news-details__img" src="{{ Voyager::image( $post->image ) }}" alt="news image">
            <h1 class="news-details__header has-text-centered">{{$post['title']}}</h1>
            <div class="columns is-centered is-multiline">
                <div class="column is-12 news-details__body">
                    {!! $post['body'] !!}
                    <span class="news-details__author">{{$post['created_at']}}</span>
                </div>
                <div class="column is-4">
                </div>
            </div>
        </div>
        <div class="column is-2 is-hidden-touch">
            <div class="columns is-multiline stream">
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