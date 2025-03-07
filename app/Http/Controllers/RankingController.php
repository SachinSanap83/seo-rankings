<?php

namespace App\Http\Controllers;
use App\Models\Keyword;
use App\Models\KeywordRanking;

use Illuminate\Http\Request;

class RankingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Keyword $keyword)
    {
        $query = $keyword->rankings()->orderBy('created_at', 'desc');
    
 
        if ($request->has('position') && $request->position !== null) {
            $query->where('position', $request->position);
        }
    
 
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
    
 
        if ($request->has('sort_by')) {
            $query->orderBy($request->sort_by, $request->get('order', 'asc'));
        }
    
        $rankings = $query->paginate(10); // Paginate results
    
        return view('rankings.index', compact('keyword', 'rankings'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
