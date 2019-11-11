<?php
/**
 * Created by PhpStorm.
 * User: apanek
 * Date: 31.10.18
 * Time: 13:49
 */
namespace App\Http\Services;
use App\YoutubeApi\YoutubeApi;
class YoutubeService
{
    private $api;

    public function __construct()
    {
        $this->api = new YoutubeApi("AIzaSyCTNjPy3Gzsn05dfSSI3z6W6Y2V4TBfDgk");
    }

    public function fetchStreams()
    {
        $streams = $this->api->fetchStreams();
        return $this->api->getViewers($streams);
    }
}