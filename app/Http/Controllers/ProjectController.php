<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())->get();
        return view('projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'url' => 'required|url',
        ]);

        Project::create([
            'name' => $request->name,
            'url' => $request->url,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('projects.index')->with('success', 'Project added successfully.');
    }

    public function show(Project $project)
    {
        $project->load('keywords');

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
{
    if ($project->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    return view('projects.edit', compact('project'));
}

public function update(Request $request, Project $project)
{
    if ($project->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'name' => 'required|string',
        'url' => 'required|url',
    ]);

    $project->update([
        'name' => $request->name,
        'url' => $request->url,
    ]);

    return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
}

}
