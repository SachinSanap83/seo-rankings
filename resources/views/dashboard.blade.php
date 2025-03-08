@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Dashboard</h2>

    <!-- Search Box -->
 <input type="text" id="searchInput" class="w-full p-2 border rounded mb-4" placeholder="Search Projects..." onkeyup="searchProjects()">
 

    <!-- Projects List -->
<div class="overflow-x-auto">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Name</th>
                <th class="p-2 border">URL</th>
                <th class="p-2 border">Keywords</th>
            </tr>
        </thead>
        <tbody id="projectTableBody">
            @foreach ($projects as $project)
            <tr class="border project-row">
                <td class="p-2 project-name">{{ $project->name }}</td>
                <td class="p-2"><a href="{{ $project->url }}" class="text-blue-500" target="_blank">{{ $project->url }}</a></td>
                <td class="p-2">
                    @foreach ($project->keywords as $keyword)
                        <span class="bg-gray-200 text-sm p-1 rounded">{{ $keyword->keyword }}</span>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


    <!-- Keyword Rankings Chart -->
     <h2 class="text-xl font-semibold mt-6">Keyword Rankings</h2>
<div id="chart"></div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
 
 @php
    // Extract all unique keywords from all projects
    $allKeywords = collect($chartData)
        ->flatMap(fn($project) => collect($project['keywords'])->pluck('name'))
        ->unique()
        ->values()
        ->toArray();

    // Generate series data for each project based on correct keyword positions
    $seriesData = collect($chartData)->map(function ($project) use ($allKeywords) {
        $rankings = collect($allKeywords)->map(function ($keyword) use ($project) {
            return collect($project['keywords'])->firstWhere('name', $keyword)['ranking'] ?? 0;
        })->toArray();

        return [
            'name' => $project['name'],
            'data' => $rankings
        ];
    })->values();
@endphp

<script>
    let allKeywords = {!! json_encode($allKeywords) !!};
    let seriesData = {!! json_encode($seriesData) !!};

    var options = {
        chart: {
            type: 'bar',
            height: 400
        },
        series: seriesData,
        xaxis: {
            categories: allKeywords,
            title: { text: 'Keywords' }
        },
        yaxis: {
            title: { text: 'Ranking Position' }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>



    <script>
    function searchProjects() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let rows = document.querySelectorAll(".project-row");

        rows.forEach(row => {
            let projectName = row.querySelector(".project-name").innerText.toLowerCase();
            if (projectName.includes(input)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>
</div>
@endsection
