<?php

namespace App\Services;

use App\Models\User;

class FileService
{
    public static function create(User $user, mixed $model, string $path)
    {
        return $model->files()->create([
            'uuid' => \Str::uuid(),
            'user_id' => $user->id,
            'path' => $path
        ]);
    }
}
