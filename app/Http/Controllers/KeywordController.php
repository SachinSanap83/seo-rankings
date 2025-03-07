<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Models\Project;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function index(Project $project)
    {
        return $project->keywords;
    }

    public function store(Request $request, Project $project)
    {
        $request->validate(['keyword' => 'required|string']);
        $project->keywords()->create($request->only('keyword'));
        return redirect()->route('projects.show', $project);
    
    }
}
