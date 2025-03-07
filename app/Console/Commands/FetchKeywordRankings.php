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

        foreach ($keywords as $keyword) {
            $rankingData = $this->dataForSEOService->fetchKeywordRanking($keyword->keyword, $keyword->project->url);

            if ($rankingData) {
                KeywordRanking::create([
                    'keyword_id' => $keyword->id,
                    'position' => $rankingData['rank_absolute'] ?? null,
                    'search_volume' => $rankingData['search_volume'] ?? 0,
                    'competition' => $rankingData['competition'] ?? 0,
                ]);
                $this->info("Ranking fetched for {$keyword->keyword}");
            } else {
                $this->warn("Failed to fetch ranking for {$keyword->keyword}");
            }
        }
    }
}
