<?php

namespace App\CustomTraits;

use Laravel\Passport\Client as PClient;
use GuzzleHttp\Client;

trait PassportTokenTrait {

    /**
     * First Token Function.
     */
    public function getFirstTokenAndRefreshToken($email, $password)
    {
        $pClient = PClient::where('password_client', 1)->first();
        $http = new Client;
        $response = $http->post(config('app.url').'/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $pClient->id,
                'client_secret' => $pClient->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ],
        ]);

        $result = json_decode((string) $response->getBody(), true);
        return $result;
    }

     /**
     * Refresh Token Function.
     */
    public function getTokenAndRefreshToken($refresh_token)
    {
        $pClient = PClient::where('password_client', 1)->first();
        $http = new Client;
        $response = $http->post(config('app.url').'/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
                'client_id' => $pClient->id,
                'client_secret' => $pClient->secret,
                'scope' => '*',
            ],
        ]);

        $result = json_decode((string) $response->getBody(), true);
        return $result;
    }
}
