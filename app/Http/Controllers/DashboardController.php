<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;


class DashboardController extends Controller
{
     public function index(LarapexChart $chart)
    {
        // Get all projects for the logged-in user
        // $projects = Project::where('user_id', auth()->id())->with('keywords.rankings')->get();

          $projects = Project::with('keywords.rankings')->get();
        
$chartData = $projects->map(function ($project) {
    return [
        'name' => $project->name,
        'keywords' => $project->keywords->map(function ($keyword) {
            return [
                'name' => $keyword->keyword ?? 'Unknown',
                'ranking' => $keyword->rankings->first()->position ?? 0
            ];
        })->toArray() ?? [] // Ensure 'keywords' is always an array
    ];
})->toArray();

return view('dashboard', compact('projects','chartData'));
    }

}
