@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Dashboard</h2>

    <!-- ✅ Search & Filter Form -->
    <form method="GET" action="{{ route('dashboard') }}" class="mb-4 flex flex-wrap gap-2">
        <input type="text" name="keyword" placeholder="Search Keyword" value="{{ request('keyword') }}" class="p-2 border rounded">
        
        <select name="project_id" class="p-2 border rounded">
            <option value="">Filter by Project</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Apply Filters</button>
    </form>

    <!-- ✅ Projects List with Keywords and Rankings -->
    @foreach ($projects as $project)
        <div class="mb-6 p-4 border rounded">
            <h3 class="text-lg font-bold">{{ $project->name }}</h3>
            <a href="{{ $project->url }}" target="_blank" class="text-blue-600">{{ $project->url }}</a>
            <!-- <p class="text-gray-500">{{ $project->url }}</p> -->

            <table class="w-full border-collapse mt-4">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 border">Keyword</th>
                        <th class="p-2 border">Position</th>
                        <th class="p-2 border">Search Volume</th>
                        <th class="p-2 border">Competition</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($project->keywords as $keyword)
                        @foreach ($keyword->rankings as $ranking)
                            <tr class="border">
                                <td class="p-2">{{ $keyword->keyword }}</td>
                                <td class="p-2">{{ $ranking->position }}</td>
                                <td class="p-2">{{ $ranking->search_volume }}</td>
                                <td class="p-2">{{ $ranking->competition }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>
@endsection
