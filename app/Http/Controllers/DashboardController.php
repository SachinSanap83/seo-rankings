<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::where('user_id', Auth::id())->with('keywords.rankings')->get();

        return view('dashboard', compact('projects'));
    }
}
