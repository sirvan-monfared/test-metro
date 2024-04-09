<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        return view('front.category.show', [
            'courses' => $category->courses()->get(),
            'category' => $category
        ]);
    }
}
