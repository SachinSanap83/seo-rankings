@extends('layouts.app')

@section('title', 'Manage Keywords')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">{{ $project->name }} - Keywords</h2>

    <form action="{{ route('keywords.store', $project) }}" method="POST" class="mb-4">
        @csrf
        <input type="text" name="keyword" placeholder="Enter Keyword" class="p-2 border rounded w-full mb-2">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Keyword</button>
    </form>

    <ul>
        @foreach ($project->keywords as $keyword)
            <li class="p-2 border-b flex justify-between">
                {{ $keyword->keyword }}
                <a href="{{ route('rankings.index', $keyword) }}" class="text-blue-600">View Rankings</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
