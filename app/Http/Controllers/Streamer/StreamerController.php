<?php

namespace App\Http\Controllers\Streamer;

use App\Http\Controllers\Controller;
use App\Http\Services\StreamerService;
use App\Http\Services\YoutubeService;
use App\MixerApi\Streams;
use App\Stream;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;

class StreamerController extends Controller
{
    public $streamerService;
    public $mixerApi;
    public $youtubeService;

    public function __construct()
    {
        $this->streamerService = new StreamerService('2ec58lis2tte9fscri8mujdvzayeyb');
        $this->youtubeService = new YoutubeService();
    }

    public function getStreams()
    {
       return $this->streamerService->fetchStreamsAndInsert(100, 100);
    }

    public function getYoutubeStreams()
    {
        return $this->youtubeService->fetchStreams();
    }

    public function loadMoreStreams(Request $request)
    {
        return $this->streamerService->loadMore($request->id, $request->platform);
    }

    public function getGames()
    {
        return $this->streamerService->updatePopularGames();
    }

    public function getTopGames()
    {
        return $this->streamerService->getTopGames();
    }
}
