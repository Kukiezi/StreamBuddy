<?php

namespace App\Http\Controllers;

use App\Http\Services\StreamerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $streamerService;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->streamerService = new StreamerService('2ec58lis2tte9fscri8mujdvzayeyb');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $popular = $this->streamerService->fetchPopularGames();
        $topTwitch = $this->streamerService->getTopThreeTwitch();
        $topMixer = $this->streamerService->getTopThreeMixer();
        $topYoutube = $this->streamerService->getTopThreeYoutube();
        if (Auth::user() != null) {
            $followedStreams = $this->streamerService->getFollowedStreams(Auth::user());
        } else {
            $followedStreams = [];
        }
        return view('home.home',
            [
                'populars' => $popular,
                'topTwitch' => $topTwitch,
                'topMixer' => $topMixer,
                'topYoutube' => $topYoutube,
                'followed' => $followedStreams
            ]);
    }

    public function login()
    {
        return view('home.login');
    }

    public static function thousandsCurrencyFormat($num)
    {

        if ($num > 1000) {
            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int)$x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];

            return $x_display;
        }

        return $num;
    }
}
