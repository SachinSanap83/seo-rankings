@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Edit Project</h2>

    <form action="{{ route('projects.update', $project) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label class="block mb-2">Project Name:</label>
        <input type="text" name="name" value="{{ $project->name }}" class="p-2 border rounded w-full mb-2">

        <label class="block mb-2">Project URL:</label>
        <input type="text" name="url" value="{{ $project->url }}" class="p-2 border rounded w-full mb-2">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Project</button>
    </form>
</div>
@endsection
