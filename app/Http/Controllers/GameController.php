<?php

namespace App\Http\Controllers;

use App\Http\Services\StreamerService;
use App\MixerApi\Streams;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public $streamerService;
    public $mixerApi;

    public function __construct()
    {
        $this->streamerService = new StreamerService('2ec58lis2tte9fscri8mujdvzayeyb');
    }


    public function index($game)
    {
        $streams = $this->streamerService->fetchStreamsForGame($game);
        $fetchedGame = $this->streamerService->fetchGameByName($game);
        $topTwitch = $this->streamerService->getTopThreeTwitch();
        $topMixer = $this->streamerService->getTopThreeMixer();
        $topYoutube = $this->streamerService->getTopThreeYoutube();
        $followedStreams = [];
        if (Auth::user() != null) {
            $followedStreams = $this->streamerService->getFollowedStreams(Auth::user());
        } else {
            $followedStreams = [];
        }
        $viewers = 0;
        if ($fetchedGame['viewers'] == null) {
            foreach ($streams as $stream) {
                $viewers += $stream['viewers'];
            }
        }
        return view('streams.game',
            [
                'streams' => $streams,
                'game' => $fetchedGame,
                'viewers' => $viewers,
                'topTwitch' => $topTwitch,
                'topMixer' => $topMixer,
                'topYoutube' => $topYoutube,
                'followed' => $followedStreams
            ]);
    }


}
