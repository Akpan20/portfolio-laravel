<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Handle avatar upload/removal
        if ($request->hasFile('avatar')) {
            $this->handleImageUpload($request, $user, 'avatar_path', 'avatars', 2 * 1024 * 1024);
        }
        if ($request->filled('remove_avatar') && $request->remove_avatar === '1') {
            $this->removeImage($user, 'avatar_path');
        }

        // Handle cover image upload/removal
        if ($request->hasFile('cover_image')) {
            $this->handleImageUpload($request, $user, 'cover_image', 'covers', 5 * 1024 * 1024);
        }
        if ($request->filled('remove_cover') && $request->remove_cover === '1') {
            $this->removeImage($user, 'cover_image');
        }

        // Handle home image upload/removal
        if ($request->hasFile('home_image')) {
            $this->handleImageUpload($request, $user, 'home_image', 'home-images', 5 * 1024 * 1024);
        }
        if ($request->filled('remove_home_image') && $request->remove_home_image === '1') {
            $this->removeImage($user, 'home_image');
        }

        // Update text fields
        $user->fill($request->validated());
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete cover image via AJAX.
     */
    public function deleteCoverImage(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            if ($user->cover_image) {
                Storage::disk('public')->delete($user->cover_image);
                $user->update(['cover_image' => null]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Cover image deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Cover delete failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete cover image.'
            ], 500);
        }
    }

    /**
     * Handle image upload with validation and consistent naming.
     */
    protected function handleImageUpload(Request $request, User $user, string $field, string $diskPath, int $maxSize): void
    {
        $file = $request->file($field);

        // Calculate max in KB for validation rule
        $maxKb = $maxSize / 1024;

        $request->validate([
            $field => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,webp',
                "max:$maxKb",
            ],
        ], [
            "{$field}.mimes" => "Only JPG, PNG, WEBP allowed for {$field}.",
            "{$field}.max"   => "The {$field} may not be greater than " . ($maxSize / 1024 / 1024) . " megabytes.",
        ]);

        // Delete old image if exists
        if ($user->{$field}) {
            Storage::disk('public')->delete($user->{$field});
        }

        // Generate filename
        $extension = $file->getClientOriginalExtension();
        $filename  = "{$field}_{$user->id}_" . time() . '_' . Str::random(8) . '.' . $extension;
        $path      = $file->storeAs($diskPath, $filename, 'public');

        $user->{$field} = $path;
        $user->saveQuietly();
    }

    /**
     * Remove image and update user field.
     */
    protected function removeImage(User $user, string $field): void
    {
        if ($user->{$field}) {
            Storage::disk('public')->delete($user->{$field});
            $user->{$field} = null;
            $user->save();
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Clean up images
        $this->removeImage($user, 'avatar_path');
        $this->removeImage($user, 'cover_image');
        $this->removeImage($user, 'home_image');

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}