<?php namespace App\Services;

use GuzzleHttp\Client;

class GoogleGeocoder
{
    const ENDPOINT = 'https://maps.googleapis.com/maps/api/geocode/json';

    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => self::ENDPOINT]);
    }

    public function geocode($address)
    {
        return $this->query($address);
    }

    public function reverse($lat, $lon)
    {
        return $this->query("{$lat} {$lon}");
    }

    protected function query($query)
    {
        $response = $this->client->get('', ['query' => [
            'address' => $query,
        ]]);

        $json = json_decode($response->getBody());

        if (!isset($json->results) || !sizeof($json->results) || 'OK' !== $json->status) {
            throw new \Exception('Запрос геоданных не удался');
        }

        $result = [];

        foreach ($json->results as $item) {
            $result[] = [
                'address' => $item->formatted_address,
                'lat'     => $item->geometry->location->lat,
                'lon'     => $item->geometry->location->lng,
                'lower_corner_lat' => $item->geometry->bounds->southwest->lat,
                'lower_corner_lon' => $item->geometry->bounds->southwest->lng,
                'upper_corner_lat' => $item->geometry->bounds->northeast->lat,
                'upper_corner_lon' => $item->geometry->bounds->northeast->lng,
            ];
        }

        return $result;
    }
}
