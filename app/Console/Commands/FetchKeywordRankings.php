<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Keyword;
use App\Models\KeywordRanking;
use App\Services\DataForSEOService;

class FetchKeywordRankings extends Command
{
    protected $signature = 'seo:fetch-rankings';
    protected $description = 'Fetch keyword rankings using DataForSEO API';

    public function __construct(protected DataForSEOService $dataForSEOService)
    {
        parent::__construct();
    }

    public function handle()
    {
        $keywords = Keyword::with('project')->get();

        $this->info('Fetching keyword rankings for ' . count($keywords) . $keywords->pluck('keyword')->implode(', '));
        

        foreach ($keywords as $keyword) {
            $rankingData = $this->dataForSEOService->fetchKeywordRanking($keyword->keyword, $keyword->project->url);

            $metricsData = $this->dataForSEOService->getKeywordMetrics($keyword->keyword);
            $position = $rankingData['position'] ?? null;
    
            $searchVolume = $metricsData['search_volume'] ?? null;
            $competition = $metricsData['competition_index'] ?? null;

            if ($rankingData) {
                KeywordRanking::updateOrCreate(
                    [ 
                        'keyword_id' => $keyword->id,
                    ],
                    [
                        'position' => $position,
                        'search_volume' => $searchVolume ?? 0,
                        'competition' => $competition ?? 0.0,
                    ]
                );
                
                $this->info("Ranking fetched for {$keyword->keyword}");
            } else {
                $this->warn("Failed to fetch ranking for {$keyword->keyword}");
            }
        }
        $this->info(' Keyword rankings updated successfully!');
    }
}
