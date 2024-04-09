<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function download(File $file)
    {
        return \Storage::disk('upload')->download($file->path);
//        dd(\Storage::disk('upload')->download($file->path));
    }
}
