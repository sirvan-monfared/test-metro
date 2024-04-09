<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Kodesign\BreadCrumbs;
use App\Kodesign\SchemaGenerator;
use App\Models\Post;
use App\Services\BreadCrumbService;

class BlogController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('front.blog.index')->with([
            'posts' => Post::published()->latest()->paginate(20),
            'breadCrumbs' => BreadCrumbService::blogIndex()->items()
        ]);
    }

    public function show(Post $post, SchemaGenerator $schema): \Illuminate\Contracts\View\View
    {
        abort_if($post->status !== Status::ACTIVE && !auth()->user()?->isAdmin(), 403);
//        $this->authorize('status-active', $post);
        $post->increment('views');

        $breadCrumbs = BreadCrumbService::blogPost($post);

        return view('front.blog.show')->with([
            'post' => $post,
            'tags' => $post->load('tagged')->tagged,
            'breadCrumbs' => $breadCrumbs->items(),
            'comments_count'    => number_format($post->publishedCommentsCount()),
            'page_schema' => $schema->blogPost($post)->toScript() . $schema->breadCrumbs($breadCrumbs)->toScript()
        ]);
    }
}
