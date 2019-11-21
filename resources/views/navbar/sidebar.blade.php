<div class="column is-narrow streams__sidebar streams__sidebar--normal is-hidden-touch">
    <aside class="menu">
        @if (Auth::user())
            <div class="column is-12 streams__sidebar--title__column">
                <p class="streams__sidebar--title followedLabel">Followed Streams</p>
            </div>
        @endif
        <div class="followedStreams">
            @foreach ($followed as $stream)
                <div class="column is-12 streams__sidebar--stream animated zoomIn faster">
                    <a href="/stream/{{$stream['platform']}}/{{$stream['user']}}">
                        <div class="columns is-multiline">
                            <div class="column is-narrow streams__sidebar--img">
                                <figure class="image is-32x32">
                                    <img class="is-rounded"
                                         src="{{ $stream['logo']}}"
                                         alt="live streamer avatar">
                                </figure>
                            </div>
                            <div class="column" style="overflow: hidden;">
                                <p class="streams__sidebar--streamer">{{$stream['user']}}</p>
                                <p class="streams__sidebar--viewers is-pulled-right">{{App\Http\Controllers\HomeController::thousandsCurrencyFormat($stream['viewers'])}}</p>
                                <p class="streams__sidebar--game">{{$stream['game']}}</p>
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="column is-12 streams__sidebar--title__column">
            <p class="streams__sidebar--title">Top Streams</p>
        </div>
        <div class="column is-12">
            <figure class="image is-16x16 twitchLabel" style="cursor: pointer;">
                <img class=""
                     src="{{asset('images/twitch.png')}}" alt="twitch logo icon"/>
            </figure>
        </div>
        <div class="twitchStreams">
            @foreach ($topTwitch as $stream)
                <div class="column is-12 streams__sidebar--stream animated zoomIn faster">
                    <a href="/stream/{{$stream['platform']}}/{{$stream['user']}}">
                        <div class="columns is-multiline">
                            <div class="column is-narrow streams__sidebar--img">
                                <figure class="image is-32x32">
                                    <img class="is-rounded"
                                         src="{{ $stream['logo']}}"
                                         alt="live streamer avatar">
                                </figure>
                            </div>
                            <div class="column" style="overflow: hidden;">
                                <p class="streams__sidebar--streamer">{{$stream['user']}}</p>
                                <p class="streams__sidebar--viewers is-pulled-right">{{App\Http\Controllers\HomeController::thousandsCurrencyFormat($stream['viewers'])}}</p>
                                <p class="streams__sidebar--game">{{$stream['game']}}</p>
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="column is-11">
            <figure class="image is-16x16 mixerLabel" style="cursor: pointer;">
                <img class=""
                     src="{{asset('images/mixerdark.png')}}" alt="twitch logo icon"/>
            </figure>
        </div>
        <div class="mixerStreams">
            @foreach ($topMixer as $stream)
                <div class="column is-12 streams__sidebar--stream animated zoomIn faster">
                    <a href="/stream/{{$stream['platform']}}/{{$stream['user']}}">
                        <div class="columns is-multiline">
                            <div class="column is-narrow streams__sidebar--img">
                                <figure class="image is-32x32">
                                    <img class="is-rounded"
                                         src="{{ $stream['logo']}}"
                                         alt="live streamer avatar">
                                </figure>
                            </div>

                            <div class="column" style="overflow: hidden;">
                                <p class="streams__sidebar--streamer">{{$stream['user']}}</p>
                                <p class="streams__sidebar--viewers is-pulled-right">{{App\Http\Controllers\HomeController::thousandsCurrencyFormat($stream['viewers'])}}</p>
                                <p class="streams__sidebar--game">{{$stream['game']}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="column is-11">
            <figure class="image youtubeLabel" style="cursor: pointer;">
                <img class=""
                     src="{{asset('images/youtube3.png')}}" alt="twitch logo icon"/>
            </figure>
        </div>
        <div class="youtubeStreams">
            @foreach ($topYoutube as $stream)
                <div class="column is-12 streams__sidebar--stream animated zoomIn faster">
                    <a href="/stream/{{$stream['platform']}}/{{$stream['user']}}">
                        <div class="columns is-multiline">
                            <div class="column is-narrow streams__sidebar--img">
                                <figure class="image is-32x32">
                                    <img class="is-rounded"
                                         src="{{ $stream['logo']}}"
                                         alt="live streamer avatar">
                                </figure>
                            </div>

                            <div class="column" style="overflow: hidden;">
                                <p class="streams__sidebar--streamer">{{$stream['user']}}</p>
                                <p class="streams__sidebar--viewers is-pulled-right">{{App\Http\Controllers\HomeController::thousandsCurrencyFormat($stream['viewers'])}}</p>
                                <p class="streams__sidebar--game">{{$stream['game']}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </aside>
</div>

<script type="text/javascript">
    (function () {
        var followed = document.querySelector('.followedLabel');
        var followedStreams = document.querySelector('.followedStreams');
        followed.addEventListener('click', function () {
            followedStreams.classList.toggle('is-hidden');
        });
        var twitch = document.querySelector('.twitchLabel');
        var twitchStreams = document.querySelector('.twitchStreams');
        twitch.addEventListener('click', function () {
            twitchStreams.classList.toggle('is-hidden');
        });
        var mixer = document.querySelector('.mixerLabel');
        var mixerStreams = document.querySelector('.mixerStreams');
        mixer.addEventListener('click', function () {
            mixerStreams.classList.toggle('is-hidden');
        });
        var youtube = document.querySelector('.youtubeLabel');
        var youtubeStreams = document.querySelector('.youtubeStreams');
        youtube.addEventListener('click', function () {
            youtubeStreams.classList.toggle('is-hidden');
        });
    })();
</script>