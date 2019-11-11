<?php

namespace App\Http\Controllers;

use App\Http\Services\StreamerService;
use App\MixerApi\Streams;

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
        $viewers = 0;
        if ($fetchedGame['viewers'] == null) {
            foreach ($streams as $stream) {
                $viewers += $stream['viewers'];
            }
        }
        return view('streams.game', ['streams' => $streams, 'game' => $fetchedGame, 'viewers' => $viewers]);
    }


}
