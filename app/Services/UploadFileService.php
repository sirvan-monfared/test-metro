<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class UploadFileService
{
    public static function upload(UploadedFile $file): string
    {
        $path = 'exercises/'. now()->year. '/'. now()->month;
        $file_name = md5($file->hashName() . uniqid() . time()) . '.zip';

        return $file->storeAs($path, $file_name, 'upload');
    }

    public static function clearTemp(string $file_paths, string $exclude = null): void
    {
        $paths = explode(',', $file_paths);
        $exclude_index = array_search($exclude, $paths);

        if ($exclude && $exclude_index >= 0) {
            unset($paths[$exclude_index]);
        }

        if (count($paths) > 0) {
            \Storage::disk('upload')->delete($paths);
        }
    }
}
