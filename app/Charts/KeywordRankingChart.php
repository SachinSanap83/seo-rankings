<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\KeywordRanking;

class KeywordRankingChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($keywordId)
    {
        $rankings = KeywordRanking::where('keyword_id', $keywordId)
            ->orderBy('created_at', 'asc')
            ->get();

        $dates = $rankings->pluck('created_at')->map(fn($date) => $date->format('M d'))->toArray();
        $positions = $rankings->pluck('position')->toArray();

        return $this->chart->lineChart()
            ->setTitle('Ranking Trend')
            ->setSubtitle('Keyword Ranking Over Time')
            ->addData('Position', $positions)
            ->setXAxis($dates);
    }
}
