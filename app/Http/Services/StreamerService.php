<?php

namespace App\Http\Services;

use App\MixerApi\Streams;
use App\Stream;
use App\Game;
use App\YoutubeApi\YoutubeApi;
use App\Counter;

class StreamerService
{
    public $twitchApi;
    public $mixerApi;
    public $youtubeApi;

    public function __construct($clientId)
    {
        $options = [
            'client_id' => $clientId,
        ];
        $this->twitchApi = new \TwitchApi\TwitchApi($options);
        $this->mixerApi = new Streams();
        $this->youtubeApi = new YoutubeApi("AIzaSyDdkF_-xuJpjnkPzVbSm6PG4SakUnHd1l8");
    }

    public function getTopGames()
    {
        $games = $this->twitchApi->getTopGames();
        return $games;
    }

    public function loadMore($id, array $platform)
    {
        $streams = array();
        if (count($platform) > 0) {
            $streams = Stream::where('id', '>', $id)->whereIn('platform', $platform)->limit(20)->get();
        } else {
            $streams = Stream::where('id', '>', $id)->where('id', '<=', $id + 20)->limit(20)->get();
        }
        return $streams;
    }

    public function fetchStreams()
    {
        $streams = Stream::all();
        $sorted = $streams->sortByDesc(function ($stream, $key) {
            return $stream->viewers;
        });
        return $sorted->values();
    }

    public function fetchPopularStreams()
    {
        $streams = Stream::all();
        $sorted = $streams->sortByDesc(function ($stream, $key) {
            return $stream->viewers;
        });
        foreach ($sorted as $key => $stream) {
            if ($key > 5) {
                unset($sorted[$key]);
            }
        }
        return $sorted;
    }

    public function fetchGamesAndInsert()
    {
        $data = array();
        $games = Game::all();
        $checked = array();
        foreach (Stream::all() as $stream) {
            if (!in_array($stream['game'], $checked) && strlen($stream['game']) > 0) {
                $game = $this->addGame($stream);
                array_push($data, $game);
                array_push($checked, $stream['game']);
            }
        }
//        return $data;
        if (count($data) > 0) {
            Game::truncate();
            Game::insert($data);
        }
        return count($data);
    }

    public function fetchGameByName($name)
    {
        return Game::where('name', $name)->first();
    }

    public function fetchPopularGames()
    {
        $games = Game::where('popular', 'true')->get();
        $sorted = $games->sortByDesc(function ($game, $key) {
            return $game->viewers;
        });
        return $sorted->values();
    }

    private function unpopularGames()
    {
        foreach (Game::where('popular', true)->get() as $game) {
            $game->popular = false;
            $game->viewers = null;
            $game->save();
        }
    }

    public function updatePopularGames()
    {
        $this->unpopularGames();
        $streams = Stream::all();
        $popularGames = array();

        foreach ($streams as $stream) {
            $flag = true;
            foreach ($popularGames as $key => $value) {
                if ($value['game'] == $stream['game']) {
                    $popularGames[$key]['popularity'] += 1;
                    $popularGames[$key]['viewers'] += $stream['viewers'];
                    $flag = false;
                }
            }
            if ($flag && $stream['game'] != 'unknown' && $stream['game'] != '') {
                $game = array(
                    'game' => $stream['game'],
                    'popularity' => 1,
                    'viewers' => $stream['viewers']
                );
                array_push($popularGames, $game);
            }
        }

        $popularity = array();
        foreach ($popularGames as $key => $row) {
            $popularity[$key] = $row['viewers'];
        }
        array_multisort($popularity, SORT_DESC, $popularGames);

        foreach ($popularGames as $key => $value) {
            $game = Game::where('name', $value['game'])->first();
            if (!$game) {
                $game = new Game();
                $game->name = $value['game'];
                $game->image = 'https://static-cdn.jtvnw.net/ttv-boxart/./The%20Deed:%20Dynasty-285x380.jpg';
                $game->save();
            }
            if ($key > 5) {
                unset($popularGames[$key]);
            } else {
                $game->popular = true;
                $game->viewers = $value['viewers'];
                $game->save();
            }
        }

        return $popularGames;
    }

    public function fetchStreamsForGame($game)
    {
        $streams = Stream::where('game', $game)->get();
        $sorted = $streams->sortByDesc(function ($stream, $key) {
            return $stream->viewers;
        });
        return $sorted->values();
    }

    public function fetchStreamsAndInsert($twitchLimit = 25, $mixerLimit = 25)
    {
        $data = array();
        $truncate = false;
        try {
            $twitchStreams = $this->twitchApi->getLiveStreams(null, null, null, 'live', $twitchLimit);
            foreach ($twitchStreams['streams'] as $stream) {
                try {
                    $array = $this->addStreamTwitch($stream);
                    array_push($data, $array);
                } catch (\Exception $e) {
                    continue;
                }
            }
        } catch (\Exception $e) {
        }
        try {
            $mixerStreams = $this->mixerApi->getLiveStreams($mixerLimit);
            foreach ($mixerStreams as $stream) {
                try {
                    $array = $this->addStreamMixer($stream);
                    array_push($data, $array);
                } catch (\Exception $e) {
                    continue;
                }
            }
        } catch (\Exception $e) {
        }
        try {
//            $youtubeCounter = Counter::find(1);
//            if ($youtubeCounter->counter > 3) {

            $youtubeStreams = $this->youtubeApi->fetchStreams();
            $youtubeStreams = $this->youtubeApi->getViewers($youtubeStreams);
            foreach ($youtubeStreams as $stream) {
                try {
                    $array = $this->addStreamYoutube((array)$stream);
                    array_push($data, $array);
                } catch (\Exception $e) {
                    continue;
                }
            }
//                $youtubeCounter->counter = 0;
//                $youtubeCounter->save();
//                $truncate = true;
//            } else {
//                $youtubeCounter->counter += 1;
//                $youtubeCounter->save();
//            }
        } catch (\Exception $e) {

        }

        $viewers = array();
        foreach ($data as $key => $row) {
            $viewers[$key] = $row['viewers'];
        }
        array_multisort($viewers, SORT_DESC, $data);
//        if ($truncate) {
        Stream::truncate();
        Stream::insert($data);
//        } else {
//            Stream::where('platform', 'mixer')->where('platform', 'youtube')->each(function ($stream, $key) {
//                $stream->delete();
//            });
//            Stream::insert($data);
//        }
        return $data;
    }


    private function addStreamTwitch(array $data)
    {
        $stream = array(
            'platform' => 'twitch',
            'preview' => isset($data['preview']['large']) ? $data['preview']['large'] : 'https://9to5mac.com/2019/09/26/twitch-new-branding-icon-logo-color/03-glitch/',
            'logo' => isset($data['channel']['logo']) ? $data['channel']['logo'] : 'https://user-images.githubusercontent.com/24848110/33519396-7e56363c-d79d-11e7-969b-09782f5ccbab.png',
            'user' => isset($data['channel']['display_name']) ? $data['channel']['display_name'] : 'unknown',
            'viewers' => isset($data['viewers']) ? $data['viewers'] : 0,
            'title' => isset($data['channel']['status']) ? $data['channel']['status'] : 'title',
            'game' => isset($data['channel']['game']) ? $data['channel']['game'] : 'unknown',
            'url' => isset($data['channel']['url']) ? $data['channel']['url'] : 'https://twitch.tv'
        );
        return $stream;
    }

    private function addStreamYoutube(array $data)
    {
        $stream = array(
            'platform' => 'youtube',
            'preview' => isset($data['snippet']['thumbnails']['high']['url']) ? $data['snippet']['thumbnails']['high']['url'] : 'https://9to5mac.com/2019/09/26/twitch-new-branding-icon-logo-color/03-glitch/',
            'logo' => isset($data['snippet']['thumbnails']['medium']['url']) ? $data['snippet']['thumbnails']['medium']['url'] : 'https://user-images.githubusercontent.com/24848110/33519396-7e56363c-d79d-11e7-969b-09782f5ccbab.png',
            'user' => isset($data['snippet']['channelTitle']) ? $data['snippet']['channelTitle'] : 'unknown',
            'viewers' => isset($data['viewers']) ? $data['viewers'] : 0,
            'title' => isset($data['snippet']['title']) ? $data['snippet']['title'] : 'title',
            'game' => isset($data['channel']['game']) ? $data['channel']['game'] : 'unknown',
            'url' => isset($data['id']['videoId']) ? 'https://www.youtube.com/watch?v=' . $data['id']['videoId'] : 'https://youtube.com'
        );
        return $stream;
    }

    private function addStreamMixer(array $data)
    {
        $stream = array(
            'platform' => 'mixer',
            'preview' => isset($data['bannerUrl']) ? $data['bannerUrl'] : 'https://cdn3-www.gamerevolution.com/assets/uploads/2019/10/Mixer-subscription-price-drop.jpg',
            'logo' => isset($data['user']['avatarUrl']) ? $data['user']['avatarUrl'] : 'https://user-images.githubusercontent.com/24848110/33519396-7e56363c-d79d-11e7-969b-09782f5ccbab.png',
            'user' => isset($data['token']) ? $data['token'] : 'unknown',
            'viewers' => isset($data['viewersCurrent']) ? $data['viewersCurrent'] : 0,
            'title' => isset($data['name']) ? $data['name'] : 'title',
            'game' => isset($data['type']['name']) ? $data['type']['name'] : 'unknown',
            'url' => isset($data['token']) ? 'https://mixer.com/' . $data['token'] : 'https://mixer.com'
        );
        return $stream;
    }

    private function addGame(Stream $data)
    {
        $game = array(
            'name' => $data['game'],
            'popular' => false
        );
        return $game;
    }

}
