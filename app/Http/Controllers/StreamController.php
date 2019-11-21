<?php

namespace App\Http\Controllers;

use App\Http\Services\NewsService;
use App\Http\Services\StreamerService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StreamController extends Controller
{
    private $streamerService;

    public function __construct()
    {
        $this->streamerService = new StreamerService('2ec58lis2tte9fscri8mujdvzayeyb');
    }


    public function index($platform, $streamer)
    {
        $topTwitch = $this->streamerService->getTopThreeTwitch();
        $topMixer = $this->streamerService->getTopThreeMixer();
        $topYoutube = $this->streamerService->getTopThreeYoutube();
        $stream = $this->streamerService->fetchStreamerWithName($streamer);
        $game = $this->streamerService->getGameLogo($streamer);
        $followedStreams = [];
        if (Auth::user() != null) {
            $followedStreams = $this->streamerService->getFollowedStreams(Auth::user());
        } else {
            $followedStreams = [];
        }
        return view('streams.stream',
            [
                'platform' => $platform,
                'streamer' => $streamer,
                'game' => $game,
                'stream' => $stream,
                'topTwitch' => $topTwitch,
                'topMixer' => $topMixer,
                'topYoutube' => $topYoutube,
                'followed' => $followedStreams
            ]);
    }

    public static function youtubeParser($url)
    {
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
        return $matches[0];
    }

    public function follow()
    {
        if (Auth::user()) {
            $user = Auth::user();
            $this->streamerService->followStreamerStatic($_POST['streamer'], $user);
        }
    }
}
