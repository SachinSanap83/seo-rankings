<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DataForSEOService
{
    protected $apiUrl = "https://api.dataforseo.com/v3/serp/google/organic/live";
    //https://docs.dataforseo.com/v3/serp/google/organic/live/regular/?bash
    protected $login = "team@dmcockpit.com";
    protected $password = "Pass@123";

    public function fetchKeywordRanking($keyword, $url)
    {
        $response = Http::withBasicAuth($this->login, $this->password)
            ->post($this->apiUrl, [
                "data" => [
                    [
                        "keyword" => $keyword,
                        "language_code" => "en",
                        "location_code" => 2840, 
                        "url" => $url,
                    ]
                ]
            ]);

        $data = $response->json();
        
        if (isset($data['tasks'][0]['result'][0]['items'])) {
            return $data['tasks'][0]['result'][0]['items'][0];
        }
        
        return null;
    }
}
