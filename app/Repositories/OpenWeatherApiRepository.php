<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class OpenWeatherApiRepository
{
    private string $baseUrl = 'https://api.openweathermap.org/data/2.5/';

    public function getCurrentWeather(float $lat, float $lng)
    {
        $response = Http::get($this->baseUrl . '/weather', [
            'lat' => $lat,
            'lon' => $lng,
            'appid' => env('OPEN_WEATHER_API_KEY')
        ]);
        $result = $response->json();
        if (isset($result['main']) && isset($result['wind']) && isset($result['name']) && isset($result['clouds'])) {
            return [
                'main' => $result['main'],
                'wind' => $result['wind'],
                'name' => $result['name'],
                'clouds' => $result['clouds']
            ];
        }

        return;
    }
}
