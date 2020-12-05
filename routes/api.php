<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tweetMedia', function()
{
    $uploaded_media = \Thujohn\Twitter\Twitter::uploadMedia(['media' => \Illuminate\Http\File::get(public_path('favicon.ico'))]);
    return \Thujohn\Twitter\Twitter::postTweet(
        ['status' => 'Laravel is beautiful',
            'media_ids' => $uploaded_media->media_id_string]);
});
