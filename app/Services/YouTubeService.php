<?php
namespace App\Services;

use GuzzleHttp\Client;

class YouTubeService
{
    protected $client;
    protected $apiUrl = 'https://www.googleapis.com/youtube/v3/search';
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.youtube.api_key'); // Store your API key in config/services.php
    }

    public function getPlaylists($subject)
    {
        $response = $this->client->request('GET', $this->apiUrl, [
            'query' => [
                'part' => 'snippet',
                'q' => $subject . ' tutorial playlist',
                'type' => 'playlist',
                'maxResults' => 3,
                'key' => $this->apiKey,
            ],
        ]);

        $playlists = json_decode($response->getBody()->getContents(), true);
        return $playlists['items'];
    }
}


?>
