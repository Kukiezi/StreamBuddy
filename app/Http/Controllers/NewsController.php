<?php

namespace App\Http\Controllers;

use App\Http\Services\NewsService;
use App\Http\Services\StreamerService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $newsService;
    private $streamerService;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->newsService = new NewsService();
        $this->streamerService = new StreamerService('2ec58lis2tte9fscri8mujdvzayeyb');
    }


    public function index()
    {
        $data = $this->newsService->fetchPostsPagination();
        $streams = $this->streamerService->fetchPopularStreams();
        return view('news.news', ['posts' => $data, 'streams' => $streams]);
    }

    public function newsView($slug)
    {
        $post = $this->newsService->fetchPostWithSlug($slug);
        $streams = $this->streamerService->fetchPopularStreams();
        return view('news.details', ['post' => $post, 'streams' => $streams]);
    }
}
