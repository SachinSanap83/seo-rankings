<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DataForSEOService
{
    protected $client;
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.dataforseo.com/',
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode('team@dmcockpit.com:Pass@123'),    
                'Content-Type' => 'application/json',
            ],
        ]);        
    } 

    public function fetchKeywordRanking($keyword, $url)
    {
        try {
            $response = $this->client->request('POST', 'v3/serp/google/organic/live/advanced', [
                'json' => [
                    [
                        'keyword' => $keyword,
                        'location_code' => '2840',
                        'language_code' => 'en'
                    ]
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            Log::info('DataForSEO SERP API Response:', $data);

            if (!empty($data['tasks'][0]['result'][0]['items'])) {
                $items = $data['tasks'][0]['result'][0]['items'];
                foreach ($items as $item) {
                    if (isset($item['domain']) && str_contains($item['domain'], $url)) {
                        return [
                            'position' => $item['rank_group'] ?? null,
                            'absolute_position' => $item['rank_absolute'] ?? null,
                            'domain' => $item['domain'] ?? null,
                            'title' => $item['title'] ?? null,
                            'url' => $item['domain'] ?? null
                        ];
                    }
                }
            }
    
            return null;

        } catch (\Exception $e) {
            Log::error('DataForSEO SERP API Error: ' . $e->getMessage());
            return [];
        }
    }

    public function getKeywordMetrics($keyword)
    {
        try {
            $response = $this->client->request('POST', 'v3/keywords_data/google_ads/search_volume/live', [
                'json' => [
                    [
                        'keywords' => [$keyword],
                        'location_code' => 2840,
                        'language_code' => 'en'
                    ]
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            Log::info('DataForSEO Search Volume API Response:', $data);
            return $data['tasks'][0]['result'][0] ?? [];

        } catch (\Exception $e) {
            Log::error('DataForSEO Search Volume API Error: ' . $e->getMessage());
            return [];
        }
    }
}
