<?php

namespace App\Repositories;

use Google_Client;
use Illuminate\Support\Facades\Http;

class FirebaseMessasingApiRepository
{
    private string $baseUrl = 'https://fcm.googleapis.com/v1/';
    private string $accessToken;
    private array $token;

    public function __construct()
    {
        $credentialsFilePath = storage_path("app/firebase/fcm.json");
        $client = new Google_Client();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $this->token = $client->fetchAccessTokenWithAssertion();
        $this->accessToken = $this->token['access_token'];
    }

    public function send(string $fcmToken, string $local)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken
        ])->post($this->baseUrl . 'projects/' . env('FIREBASE_PROJECT_ID') . '/messages:send', [
            'message' => [
                'token' => $fcmToken,
                'notification' => [
                    'body' => 'Acesse o app! E veja as mudanças',
                    'title' => 'O clima em ' . $local . ' mudou!'
                ]
            ]
        ]);
        return $response->json();
    }
}
