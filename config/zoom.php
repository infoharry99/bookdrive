<?php

return [
    'api_key' => env('ZOOM_CLIENT_KEY'),
    'api_secret' => env('ZOOM_CLIENT_SECRET'),
    'base_url' => 'https://api.zoom.us/v2/',
    'token_life' => 60 * 60 * 24 * 7, // In seconds, default 1 week
    'authentication_method' => 'OAuth2', // Only jwt compatible at present but will add OAuth2
    'max_api_calls_per_request' => '5' // how many times can we hit the api to return results for an all() request
];

// return [
//     POST https://zoom.us/oauth/token?grant_type=account_credentials&account_id={accountId}
// HTTP/1.1
// Host: zoom.us
// Authorization: Basic Base64Encoder(clientId:clientSecret)
// ]