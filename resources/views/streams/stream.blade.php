@extends('layouts.app', ['title' => 'Watch ' . $streamer . ' from ' . $platform,
'description' => 'Cross-platform live steams browser. View streams from Twitch, Youtube and Mixer in one place.'])

@section('content')
    {{--    <div style="overflow: hidden;">--}}
    <div class="column is-12" style="padding: 0">
        <div class="columns is-multiline" id="over" style="margin-right: 0; margin-left: 0">

            @include('navbar.sidebar', ['topTwitch' => $topTwitch, 'topMixer' => $topMixer, 'topYoutube' => $topYoutube])
            @include('navbar.sidebarsmall', ['topTwitch' => $topTwitch, 'topMixer' => $topMixer, 'topYoutube' => $topYoutube])
            <div class="column live is-relative">
                <div class="columns is-multiline is-mobile">
                    <div class="column is-12 live__stream-column" style="padding-left: 0;">
                        <div class="video-container">
                            @if ($platform == 'twitch')
                                <iframe src="https://player.twitch.tv/?channel={{$streamer}}"
                                        frameborder="0"
                                        allowfullscreen="true"
                                        scrolling="no"
                                        width="640" height="360"
                                ></iframe>
                            @elseif ($platform == 'mixer')
                                <iframe src="https://mixer.com/embed/player/{{$streamer}}?disableLowLatency=0"
                                        frameborder="0"
                                        allowfullscreen="true"
                                        scrolling="no"
                                        width="640" height="360"
                                ></iframe>

                            @elseif ($platform == 'youtube')
                                <iframe src="https://www.youtube.com/embed/{{App\Http\Controllers\StreamController::youtubeParser($stream['url'])}}"
                                        frameborder="0" width="640" height="360"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            @endif
                        </div>
                    </div>
                    <div class="column is-narrow is-hidden-mobile"
                         style="padding-top: 0; padding-bottom: 0; padding-right: 0;">
                        <img class="live__stream-image" src="{{$game['image']}}" alt="image of chosen game"/>
                    </div>
                    <div class="column is-12-mobile live__stream"
                         style="padding-top: 0; padding-bottom: 0; padding-left: 0;">
                        <p style="display: inline-block;" class="live__stream-title">{{ $stream['title'] }}</p>
                        <div class="is-pulled-right">
                            <span style="color: white"><i class="far fa-eye"></i></span>
                            <p class="live__stream-viewers">{{ $stream['viewers'] }}</p>
                        </div>
                        <p class="live__stream-game">{{ $game['name'] }}</p>
                    </div>
                </div>
            </div>
            <div class="column is-narrow is-12-mobile live__menu-column" style="padding-left: 0; padding-right: 0;">
                <aside class="live__menu">
                    @if ($platform == 'twitch')
                        <iframe class="live__chat-container"
                                src="https://www.twitch.tv/embed/{{$streamer}}/chat?darkpopout"
                                frameborder="0"
                                scrolling="no"></iframe>
                    @elseif ($platform == 'mixer')
                        <iframe class="live__chat-container" allowfullscreen="true"
                                src="https://mixer.com/embed/chat/{{$streamer}}"
                        ></iframe>
                    @elseif ($platform == 'youtube')
                        <iframe class="live__chat-container" allowfullscreen="" frameborder="0" height="270"
                                src="https://www.youtube.com/live_chat?v=OYP2_g-KAJ0&embed_domain=www.streambuddy.tv/stream/youtube/{{App\Http\Controllers\StreamController::youtubeParser($stream['url'])}}"
                        ></iframe>
                    @endif
                </aside>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // (function () {
        //     var docWidth = document.documentElement.offsetWidth;
        //
        //     [].forEach.call(
        //         document.querySelectorAll('*'),
        //         function (el) {
        //             if (el.offsetWidth > docWidth) {
        //                 console.log(el);
        //                 console.log('xd')
        //             }
        //         }
        //     );
        // })();
        function scrollEventHandler() {
            var over = document.body;
            over.scroll(0, 0)
            window.scroll(0, 0)
        }

        window.addEventListener("scroll", scrollEventHandler, false);
    </script>
@endsection
