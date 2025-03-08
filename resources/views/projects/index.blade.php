@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Projects</h2>

    <form action="{{ route('projects.store') }}" method="POST" class="mb-4">
        @csrf
        <input type="text" name="name" placeholder="Project Name" class="p-2 border rounded w-full mb-2">
        <input type="url" name="url" placeholder="Project URL" class="p-2 border rounded w-full mb-2">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Project</button>
    </form>

    <ul>
        @foreach ($projects as $project)
            <li class="p-2 border-b">
                <a href="{{ route('projects.show', $project) }}" class="text-blue-600">{{ $project->name }}</a>
                <div>
                <a href="{{ route('projects.edit', $project) }}" class="text-green-500 mr-2">Edit</a>

            </div> 
            <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">Delete</button>
            </form>

            </li>
        @endforeach
    </ul>
</div>
@endsection
