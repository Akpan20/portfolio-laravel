@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">

        <!-- Page Header -->
        <div class="mb-10">
            <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-3xl p-8 shadow-2xl">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10">
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-3">Profile Settings</h1>
                    <p class="text-lg md:text-xl text-blue-100">Manage your account information and preferences</p>
                </div>
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-purple-400/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-blue-400/20 rounded-full blur-3xl"></div>
            </div>
        </div>

        <!-- Global Success Message -->
        @if (session('success'))
            <div class="mb-8 p-4 bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 rounded-xl shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-base font-medium text-green-800 dark:text-green-300">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Main Form -->
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PATCH')

            <!-- 1. Profile Photo -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <span class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        Profile Photo
                    </h2>
                </div>

                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <!-- Preview + Overlay -->
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full blur-xl opacity-40 group-hover:opacity-70 transition-opacity"></div>
                            <img id="avatarPreview" 
                                 src="{{ $user->avatar_url }}" 
                                 alt="Your profile photo"
                                 class="relative w-40 h-40 rounded-full object-cover ring-4 ring-white dark:ring-gray-800 shadow-2xl">
                            <button type="button" onclick="document.getElementById('avatarInput').click()"
                                    class="absolute inset-0 rounded-full bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-all duration-300">
                                <div class="text-white text-center">
                                    <svg class="w-10 h-10 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.66-.9l.82-1.2A2 2 0 0110.27 4h3.46a2 2 0 011.59.79l.82 1.2A2 2 0 0017.07 7H18a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="text-sm font-medium">Change</span>
                                </div>
                            </button>
                        </div>

                        <!-- Controls -->
                        <div class="flex-1 space-y-4">
                            <input id="avatarInput" type="file" name="avatar" accept="image/jpeg,image/png,image/webp"
                                   class="hidden" onchange="previewImage(event, 'avatarPreview')">

                            <div class="flex flex-wrap gap-4">
                                <button type="button" onclick="document.getElementById('avatarInput').click()"
                                        class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Upload New Photo
                                </button>

                                @if($user->avatar_path)
                                    <button type="button" onclick="removeAvatar()"
                                            class="inline-flex items-center gap-2 px-6 py-3 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl border border-gray-300 dark:border-gray-600 hover:border-red-500 hover:text-red-600 dark:hover:text-red-400 shadow-md transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Remove Photo
                                    </button>
                                @endif
                            </div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">JPG, PNG, WEBP • Max 2 MB</p>
                            <input type="hidden" name="remove_avatar" id="removeAvatarFlag" value="">

                            @error('avatar')
                                <div class="p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg text-sm text-red-700 dark:text-red-400">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Cover Image -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <span class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        Cover Image
                    </h2>
                </div>

                <div class="p-6 space-y-6">
                    <div>
                        <label for="coverImageInput" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Choose cover image
                        </label>
                        <input type="file" id="coverImageInput" name="cover_image" accept="image/jpeg,image/png,image/webp"
                               class="block w-full text-sm text-gray-900 dark:text-gray-300 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-indigo-900/30 file:text-blue-700 dark:file:text-indigo-300 hover:file:bg-blue-100 dark:hover:file:bg-indigo-900/50 border border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer bg-gray-50 dark:bg-gray-700 transition"
                               onchange="previewImage(event, 'coverPreviewImg', 'coverPreview')">
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">JPG, PNG, WEBP • Max 5 MB</p>

                        @error('cover_image')
                            <div class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg text-sm text-red-700 dark:text-red-400">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Live Preview -->
                    <div id="coverPreview" class="hidden">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Preview (will be saved on submit)</p>
                        <div class="relative rounded-xl overflow-hidden shadow-lg border border-gray-200 dark:border-gray-700">
                            <img id="coverPreviewImg" src="" alt="Cover preview" class="w-full h-48 md:h-64 object-cover">
                            <button type="button" onclick="clearCoverPreview()"
                                    class="absolute top-4 right-4 p-2.5 bg-red-600 hover:bg-red-700 text-white rounded-full shadow-lg transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Current Cover + Delete Button -->
                    @if($user->cover_image)
                        <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                Current cover image
                            </p>

                            <div class="relative group rounded-xl overflow-hidden shadow-lg border border-gray-200 dark:border-gray-700">
                                <img
                                    src="{{ $user->cover_image_url }}"
                                    alt="Current cover image"
                                    class="w-full h-48 md:h-64 object-cover"
                                >

                                <button
                                    type="button"
                                    onclick="deleteCoverImage()"
                                    class="absolute top-4 right-4 p-2.5 bg-red-600/90 hover:bg-red-700 text-white rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all"
                                    title="Delete cover image"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif

                    <input type="hidden" name="remove_cover" id="removeCoverFlag" value="">
                </div>
            </div>

            <!-- 3. Home Page Image -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <span class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </span>
                        Home Page Image
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        This image appears on the public home page (different from your profile avatar)
                    </p>
                </div>

                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <!-- Preview + Overlay -->
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full blur-xl opacity-40 group-hover:opacity-70 transition-opacity"></div>
                            @if($user->hasHomeImage())
                                <img id="homeImagePreview" 
                                     src="{{ $user->home_image_url }}" 
                                     alt="Home page image"
                                     class="relative w-40 h-40 rounded-full object-cover ring-4 ring-white dark:ring-gray-800 shadow-2xl">
                            @else
                                <img id="homeImagePreview" 
                                     src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'User') }}&background=9333EA&color=fff&size=160" 
                                     alt="Home page image"
                                     class="relative w-40 h-40 rounded-full object-cover ring-4 ring-white dark:ring-gray-800 shadow-2xl">
                            @endif
                            <button type="button" onclick="document.getElementById('homeImageInput').click()"
                                    class="absolute inset-0 rounded-full bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-all duration-300">
                                <div class="text-white text-center">
                                    <svg class="w-10 h-10 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.66-.9l.82-1.2A2 2 0 0110.27 4h3.46a2 2 0 011.59.79l.82 1.2A2 2 0 0017.07 7H18a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="text-sm font-medium">Change</span>
                                </div>
                            </button>
                        </div>

                        <!-- Controls -->
                        <div class="flex-1 space-y-4">
                            <input id="homeImageInput" type="file" name="home_image" accept="image/jpeg,image/png,image/webp"
                                   class="hidden" onchange="previewImage(event, 'homeImagePreview')">

                            <div class="flex flex-wrap gap-4">
                                <button type="button" onclick="document.getElementById('homeImageInput').click()"
                                        class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-medium rounded-xl hover:from-purple-700 hover:to-pink-700 shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Upload New Image
                                </button>

                                @if($user->hasHomeImage())
                                    <button type="button" onclick="removeHomeImage()"
                                            class="inline-flex items-center gap-2 px-6 py-3 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl border border-gray-300 dark:border-gray-600 hover:border-red-500 hover:text-red-600 dark:hover:text-red-400 shadow-md transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Remove Image
                                    </button>
                                @endif
                            </div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">JPG, PNG, WEBP • Max 2 MB</p>
                            <input type="hidden" name="remove_home_image" id="removeHomeImageFlag" value="">

                            @error('home_image')
                                <div class="p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg text-sm text-red-700 dark:text-red-400">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Personal Information -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <span class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        Personal Information
                    </h2>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required maxlength="255"
                               class="block w-full px-4 py-3 rounded-xl border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }} dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                               placeholder="Enter your full name">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="relative">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                               class="block w-full px-4 py-3 rounded-xl border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300 dark:border-gray-600' }} dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition pr-28"
                               placeholder="your.email@example.com">

                        @if($user->hasVerifiedEmail())
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-300">
                                    Verified
                                </span>
                            </div>
                        @endif

                        @error('email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Verification Notice -->
                    @if(!$user->hasVerifiedEmail())
                        <div class="p-4 bg-amber-50 dark:bg-amber-900/20 border-l-4 border-amber-400 rounded-xl">
                            <p class="text-sm text-amber-800 dark:text-amber-300 font-medium">Your email is not verified.</p>
                            <p class="text-sm text-amber-700 dark:text-amber-400 mt-1">Please check your inbox (or spam) for the verification link.</p>
                            <button type="button" onclick="resendVerification()"
                                    class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-amber-100 hover:bg-amber-200 dark:bg-amber-800/30 dark:hover:bg-amber-800/50 text-amber-800 dark:text-amber-300 rounded-lg transition text-sm font-medium">
                                Resend Verification Email
                            </button>
                            <p id="verificationSent" class="hidden mt-3 text-sm text-green-600 dark:text-green-400 font-medium">
                                ✓ Verification link sent!
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-end pt-4">
                <button type="submit"
                        class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-xl hover:shadow-2xl hover:from-indigo-700 hover:to-purple-700 transform hover:-translate-y-1 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Save All Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Shared preview function
function previewImage(event, previewId, containerId = null) {
    const file = event.target.files[0];
    if (!file) return;

    const maxSize = event.target.name === 'avatar' ? 2 * 1024 * 1024 : 5 * 1024 * 1024;
    if (file.size > maxSize) {
        alert(`File size exceeds ${maxSize / 1024 / 1024}MB limit`);
        event.target.value = '';
        return;
    }

    if (!['image/jpeg','image/png','image/webp'].includes(file.type)) {
        alert('Only JPG, PNG, WEBP allowed');
        event.target.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById(previewId).src = e.target.result;
        if (containerId) {
            document.getElementById(containerId).classList.remove('hidden');
        }
    };
    reader.readAsDataURL(file);
}

function removeAvatar() {
    const defaultAvatar = `https://ui-avatars.com/api/?name=${encodeURIComponent("{{ addslashes($user->name ?? 'User') }}")}&background=4F46E5&color=fff&size=160`;
    document.getElementById('avatarPreview').src = defaultAvatar;
    document.getElementById('removeAvatarFlag').value = '1';
    document.getElementById('avatarInput').value = '';
}

function removeHomeImage() {
    const defaultImage = `https://ui-avatars.com/api/?name=${encodeURIComponent("{{ addslashes($user->name ?? 'User') }}")}&background=9333EA&color=fff&size=160`;
    document.getElementById('homeImagePreview').src = defaultImage;
    document.getElementById('removeHomeImageFlag').value = '1';
    document.getElementById('homeImageInput').value = '';
}

function clearCoverPreview() {
    document.getElementById('coverImageInput').value = '';
    document.getElementById('coverPreviewImg').src = '';
    document.getElementById('coverPreview').classList.add('hidden');
}

async function deleteCoverImage() {
    if (!confirm('Remove your cover image?')) return;

    try {
        const response = await fetch('{{ route("profile.cover-image.delete") }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
        });

        const data = await response.json();

        if (data.success) {
            alert(data.message || 'Cover image removed');
            window.location.reload();
        } else {
            alert(data.message || 'Failed to remove cover image');
        }
    } catch (err) {
        console.error(err);
        alert('Something went wrong. Please try again.');
    }
}

async function resendVerification() {
    try {
        const response = await fetch('{{ route("verification.send") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
        });

        if (response.ok) {
            document.getElementById('verificationSent').classList.remove('hidden');
            setTimeout(() => document.getElementById('verificationSent').classList.add('hidden'), 5000);
        } else {
            alert('Failed to resend verification email.');
        }
    } catch (err) {
        console.error(err);
        alert('Network error. Please try again.');
    }
}

// Auto-dismiss success message after 5 seconds
document.addEventListener('DOMContentLoaded', () => {
    const msg = document.getElementById('successMessage');
    if (msg) {
        setTimeout(() => {
            msg.style.transition = 'opacity 0.5s';
            msg.style.opacity = '0';
            setTimeout(() => msg.remove(), 500);
        }, 5000);
    }
});
</script>
@endsection