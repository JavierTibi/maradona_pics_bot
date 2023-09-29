<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\File;

class TwitterController extends Controller
{
    protected TwitterOAuth $connection;

    public function __construct() {
        $this->connection = new TwitterOAuth(env('TWITTER_CONSUMER_KEY'), env('TWITTER_CONSUMER_SECRET'), env('TWITTER_ACCESS_TOKEN'), env('TWITTER_ACCESS_TOKEN_SECRET'));
    }

    public function tweet() {

        $n = rand(1,1313);
        $path = resource_path() . '/images/'. $n.'.jpg';
        $media = $this->connection->upload('media/upload', ['media' => File::get($path)]);
        $parameters = [
            'status' => '',
            'media_ids' => $media->media_id_string
        ];

        $response = $this->connection->post('statuses/update', $parameters);
        return json_encode($response);
    }
}
