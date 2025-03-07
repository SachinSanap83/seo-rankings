@extends('layouts.app')

@section('title', 'Keyword Rankings')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">{{ $keyword->keyword }} - Rankings</h2>

    <!-- ✅ Search and Filter Form -->
    <form method="GET" action="{{ route('rankings.index', $keyword) }}" class="mb-4 flex flex-wrap gap-2">
        <input type="number" name="position" placeholder="Filter by Position" value="{{ request('position') }}" class="p-2 border rounded">
        
        <input type="date" name="start_date" value="{{ request('start_date') }}" class="p-2 border rounded">
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="p-2 border rounded">

        <select name="sort_by" class="p-2 border rounded">
            <option value="">Sort By</option>
            <option value="position" {{ request('sort_by') == 'position' ? 'selected' : '' }}>Position</option>
            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date</option>
        </select>

        <select name="order" class="p-2 border rounded">
            <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descending</option>
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Apply Filters</button>
    </form>

    <!-- ✅ Rankings Table -->
    <table class="w-full border-collapse">
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

    <!-- ✅ Pagination -->
    <div class="mt-4">
        {{ $rankings->links() }}
    </div>
</div>
@endsection
