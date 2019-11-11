<?php

namespace App\MixerApi;

class Streams
{
    public function getLiveStreams($limit)
    {
        $data = array(
            'fields' => 'type,-description',
//            'fields' => 'user,type,thumbnail,-description',
            'order' => 'viewersCurrent:DESC',
            'limit' => $limit,
        );
        $params = '';
        foreach ($data as $key => $value)
            $params .= $key . '=' . $value . '&';

        $params = trim($params, '&');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Client-ID: 30f45db62c8d0da5e46f82b5c53b7cd4427602f35b6a6029',
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_URL, 'https://mixer.com/api/v1/channels' . '?' . $params);
        $result = curl_exec($curl);
        curl_close($curl);
        $mixerStreams = json_decode($result, true);
//        $mixerStreams = $this->changeKey($mixerStreams, 'viewersCurrent', 'viewers');
        return $mixerStreams;
    }

    private function changeKey($arr, $oldkey, $newkey)
    {
        $json = str_replace('"' . $oldkey . '":', '"' . $newkey . '":', json_encode($arr));
        return json_decode($json, true);
    }

}