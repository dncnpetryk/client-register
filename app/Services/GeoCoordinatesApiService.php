<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Spatie\Geocoder\Geocoder;

class GeoCoordinatesApiService
{
    private Geocoder $geocoder;

    public function __construct(string $apiKey, Geocoder $geocoder)
    {
        $this->geocoder = $geocoder->setApiKey($apiKey);
    }

    public function getCoordinatesByAddress(string $address): array
    {
        if ($coordinates = Cache::store('redis')->get($address)) {
            return json_decode($coordinates, true);
        }

        $coordinates = Arr::only(
            $this->geocoder->getCoordinatesForAddress($address),
            ['lat', 'lng',]
        );

        Cache::store('redis')->set($address, json_encode($coordinates));

        return $coordinates;
    }
}
