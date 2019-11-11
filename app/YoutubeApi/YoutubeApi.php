<?php

namespace App\YoutubeAPi;

use Google_Client;
use Google_Service_YouTube;

class YoutubeApi
{
    private $apiKey;
    private $service;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $client = new Google_Client();
        $client->setDeveloperKey($this->apiKey);
        $this->service = new Google_Service_YouTube($client);
    }

    public function fetchStreams()
    {
        $queryParams = [
            'eventType' => 'live',
            'type' => 'video',
            'videoCategoryId' => 20,
            'maxResults' => 50,
            'order' => 'viewCount',
            'relevanceLanguage' => 'en'
        ];
        $result = $this->service->search->listSearch('snippet', $queryParams);
        $youtubeStreams = json_encode($result['items'], true);
        $youtubeStreams = json_decode($youtubeStreams, true);
        return $youtubeStreams;
    }

    public function getViewers($streams)
    {
        $id = '';

        foreach ($streams as $stream) {
            $id .= $stream['id']['videoId'] . ',';
        }
        $paramsId = substr($id, 0, -1);
        $queryParams = [
            'id' => $paramsId,
        ];
        $result = $this->service->videos->listVideos('liveStreamingDetails', $queryParams);
        $viewers = json_encode($result['items'], true);
        $viewers = json_decode($viewers, true);
        for ($i = 0; $i < count($viewers); $i++) {
            $streams[$i]['viewers'] = $viewers[$i]['liveStreamingDetails']['concurrentViewers'];
        }
//        return $viewers[3]['liveStreamingDetails'];
        return $streams;
    }

}