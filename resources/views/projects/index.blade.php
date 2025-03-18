@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<div class="bg-gray-100 min-h-screen py-10">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
 

        <!-- Project Creation Form -->
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm mb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">Create a New Project</h3>
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="text" name="name" placeholder="Project Name" class="p-3 border border-gray-300 rounded-lg w-full focus:ring focus:ring-blue-300">
                </div>
                <div class="mb-4">
                    <input type="text" name="url" placeholder="Project URL" class="p-3 border border-gray-300 rounded-lg w-full focus:ring focus:ring-blue-300">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg transition">Create Project</button>
            </form>
        </div>

        <!-- Project List -->
        <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-700 mb-3">📌 Projects</h2>
            @foreach ($projects as $project)
                <div class="bg-white p-4 rounded-lg shadow-sm flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <a href="{{ route('projects.show', $project) }}" class="text-lg font-semibold text-blue-600 hover:underline">{{ $project->name }}</a>
                       <p> <a href="{{ $project->url }}" class="text-gray-500 text-sm" target="_blank">{{ $project->url }}</a><p>
                    </div>

                    <div class="flex space-x-3">
                        <a href="{{ route('projects.edit', $project) }}" class="text-green-600 hover:text-green-700 font-medium">✏️ Edit</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600 font-medium">🗑 Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
