@extends('layouts.app')

@section('title', 'Keyword Rankings')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">{{ $keyword->keyword }} - Rankings</h2>


    <div id="chart"></div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var chart = new ApexCharts(document.querySelector("#chart"), {!! $chartData->toJson() !!});
        chart.render();
    </script>

    <!-- ✅ Rankings Table -->
    <table class="w-full border-collapse mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Date</th>
                <th class="p-2 border">Position</th>
                <th class="p-2 border">Search Volume</th>
                <th class="p-2 border">Competition</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rankings as $ranking)
                <tr class="border">
                    <td class="p-2">{{ $ranking->created_at->format('Y-m-d') }}</td>
                    <td class="p-2">{{ $ranking->position }}</td>
                    <td class="p-2">{{ $ranking->search_volume }}</td>
                    <td class="p-2">{{ $ranking->competition }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
