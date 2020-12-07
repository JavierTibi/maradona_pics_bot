<?php

use Illuminate\Support\Facades\Route;

use Thujohn\Twitter\Facades\Twitter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tweetMedia', function()
{
    $n = rand(1,26);
    $uploaded_media = Twitter::uploadMedia(['media' => File::get(public_path('storage/'.$n.'.jpg'))]);
    try {
        return Twitter::postTweet(
            ['status' => '',
                'media_ids' => $uploaded_media->media_id_string]);
    } catch (Exception $exception) {
        dd(Twitter::logs());
    }

});

Route::get('/tweet', function()
{
    try {
        return Twitter::postTweet(['status' => 'D10S', 'format' => 'json']);

    } catch (Exception $exception) {
        dd(Twitter::logs());
    }
});
