<?php

namespace App\Http\Controllers\Streamer;

use App\Http\Controllers\Controller;
use App\Http\Services\StreamerService;
use App\Http\Services\YoutubeService;
use App\MixerApi\Streams;
use App\Stream;
use App\User;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function follow(Request $request)
    {
        $user = User::find($request->userId);
        return $this->streamerService->followStreamer($request->all(), $user);
    }

    public function getFollowers(Request $request)
    {
        $user = User::find($request->userId);
        return $this->streamerService->getFollowers($user);
    }

    public function getGames()
    {
        return $this->streamerService->updatePopularGames();
    }

    public function getTopGames()
    {
        return $this->streamerService->fetchPopularGames();
    }
}
