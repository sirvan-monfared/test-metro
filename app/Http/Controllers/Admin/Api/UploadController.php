<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function __invoke(Request $request)
    {
        if(!$image = $request->file('upload')) {
            return;
        } 
            $image_name = time() . '.' . $image->extension();
            $image->move(public_path('images/uploads'), $image_name);

            return response([
                "uploaded" => 1,
                "fileName" => $image_name,
                "url" => url("images/uploads/{$image_name}")
            ]);
        
    }
}
