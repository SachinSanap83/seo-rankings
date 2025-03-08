@extends('layouts.app')

@section('title', 'Manage Keywords')

@section('content')
<div class="bg-gray-100 min-h-screen py-10">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">🔑 {{ $project->name }} - Manage Keywords</h2>

        <!-- Keyword Addition Form -->
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm mb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">Add a New Keyword</h3>
            <form action="{{ route('keywords.store', $project) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="text" name="keyword" placeholder="Enter Keyword" class="p-3 border border-gray-300 rounded-lg w-full focus:ring focus:ring-blue-300">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg transition"> Add Keyword</button>
            </form>
        </div>

        <!-- Keywords List -->
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">📋 Keyword List</h3>
            <ul class="space-y-3">
                @foreach ($project->keywords as $keyword)
                    <li class="bg-gray-50 p-3 rounded-lg shadow-sm flex justify-between items-center hover:shadow-md transition">
                        <span class="text-gray-800 font-medium">#️⃣ {{ $keyword->keyword }}</span>
                        <a href="{{ route('rankings.index', $keyword) }}" class="text-blue-600 hover:underline">📊 View Rankings</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
