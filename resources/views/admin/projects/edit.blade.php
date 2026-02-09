@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Edit Project</h1>
                    <p class="mt-1 text-sm text-gray-600">Update project: {{ $project->title }}</p>
                </div>
                <a href="{{ route('admin.projects.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Projects
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Project Title <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       id="title"
                       value="{{ old('title', $project->title) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                       placeholder="My Awesome Project"
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea name="description" 
                          id="description"
                          rows="5"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                          placeholder="Describe your project..."
                          required>{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Technologies -->
            <div class="mb-6">
                <label for="technologies" class="block text-sm font-medium text-gray-700 mb-2">
                    Technologies
                </label>
                <div id="technologies-container" class="space-y-2 mb-2">
                    @php
                        $technologies = old('technologies', $project->technologies ?? []);
                        if (is_string($technologies)) {
                            $technologies = json_decode($technologies, true) ?? [];
                        }
                    @endphp
                    
                    @if(count($technologies) > 0)
                        @foreach($technologies as $tech)
                            <div class="flex gap-2">
                                <input type="text" 
                                       name="technologies[]" 
                                       value="{{ $tech }}"
                                       class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="e.g., Laravel, React, Vue.js">
                                <button type="button" 
                                        onclick="this.parentElement.remove()"
                                        class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors">
                                    Remove
                                </button>
                            </div>
                        @endforeach
                    @else
                        <div class="flex gap-2">
                            <input type="text" 
                                   name="technologies[]" 
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="e.g., Laravel, React, Vue.js">
                            <button type="button" 
                                    onclick="this.parentElement.remove()"
                                    class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors">
                                Remove
                            </button>
                        </div>
                    @endif
                </div>
                <button type="button" 
                        onclick="addTechnology()"
                        class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Technology
                </button>
                @error('technologies.*')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- URLs -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="demo_url" class="block text-sm font-medium text-gray-700 mb-2">
                        Demo URL
                    </label>
                    <input type="url" 
                           name="demo_url" 
                           id="demo_url"
                           value="{{ old('demo_url', $project->demo_url) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('demo_url') border-red-500 @enderror"
                           placeholder="https://demo.example.com">
                    @error('demo_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="github_url" class="block text-sm font-medium text-gray-700 mb-2">
                        GitHub URL
                    </label>
                    <input type="url" 
                           name="github_url" 
                           id="github_url"
                           value="{{ old('github_url', $project->github_url) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('github_url') border-red-500 @enderror"
                           placeholder="https://github.com/username/repo">
                    @error('github_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Current Image -->
            @if($project->image_path)
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Current Image
                </label>
                <div class="flex items-start gap-4">
                    <img src="{{ Storage::url($project->image_path) }}" 
                         alt="{{ $project->title }}"
                         class="w-48 h-32 object-cover rounded-lg border border-gray-200">
                    <div class="flex-1">
                        <p class="text-sm text-gray-600">
                            Upload a new image to replace the current one
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Image Upload -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $project->image_path ? 'Replace' : 'Upload' }} Project Image
                </label>
                <input type="file" 
                       name="image" 
                       id="image"
                       accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('image') border-red-500 @enderror">
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Max file size: 2MB. Supported formats: JPEG, PNG, JPG, GIF, WebP</p>
            </div>

            <!-- Options -->
            <div class="mb-6 space-y-4">
                <div class="flex items-center">
                    <input type="checkbox" 
                           name="is_featured" 
                           id="is_featured"
                           value="1"
                           {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                           class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="is_featured" class="ml-2 text-sm text-gray-700">
                        Mark as featured project
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" 
                           name="is_active" 
                           id="is_active"
                           value="1"
                           {{ old('is_active', $project->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="is_active" class="ml-2 text-sm text-gray-700">
                        Make project active (visible to public)
                    </label>
                </div>
            </div>

            <!-- Order -->
            <div class="mb-6">
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                    Display Order
                </label>
                <input type="number" 
                       name="order" 
                       id="order"
                       min="0"
                       value="{{ old('order', $project->order ?? 0) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('order') border-red-500 @enderror"
                       placeholder="0">
                @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.projects.index') }}" 
                   class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg shadow hover:shadow-md transition-all duration-200 transform hover:-translate-y-0.5">
                    Update Project
                </button>
            </div>
        </form>

        <!-- Delete Project -->
        <div class="mt-8 bg-red-50 border border-red-200 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-red-900 mb-2">Danger Zone</h3>
            <p class="text-sm text-red-700 mb-4">
                Once you delete this project, there is no going back. Please be certain.
            </p>
            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Delete Project
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function addTechnology() {
    const container = document.getElementById('technologies-container');
    const div = document.createElement('div');
    div.className = 'flex gap-2';
    div.innerHTML = `
        <input type="text" 
               name="technologies[]" 
               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
               placeholder="e.g., Laravel, React, Vue.js">
        <button type="button" 
                onclick="this.parentElement.remove()"
                class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors">
            Remove
        </button>
    `;
    container.appendChild(div);
}
</script>
@endsection