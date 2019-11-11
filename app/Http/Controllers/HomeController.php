<?php

namespace App\Http\Controllers;
use App\Http\Services\StreamerService;
use Illuminate\Http\Request;

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
        return view('home.home', ['populars' => $popular]);
    }
}
