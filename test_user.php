<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::find(1);

echo "=== User Data ===\n";
echo "Name: " . $user->name . "\n";
echo "Avatar Path: " . $user->avatar_path . "\n";
echo "Cover Image: " . $user->cover_image . "\n";
echo "Updated At: " . $user->updated_at . "\n\n";

echo "=== Computed URLs ===\n";
echo "Avatar URL: " . $user->avatar_url . "\n";
echo "Cover URL: " . $user->cover_image_url . "\n\n";

echo "=== Storage Check ===\n";
echo "Avatar exists in storage: " . (Storage::exists($user->avatar_path) ? 'YES' : 'NO') . "\n";
echo "Cover exists in storage: " . (Storage::exists($user->cover_image) ? 'YES' : 'NO') . "\n\n";

echo "=== Direct URLs ===\n";
echo "Avatar direct: http://127.0.0.1:8080/storage/" . str_replace('storage/', '', $user->avatar_path) . "\n";
echo "Cover direct: http://127.0.0.1:8080/storage/" . str_replace('storage/', '', $user->cover_image) . "\n";
