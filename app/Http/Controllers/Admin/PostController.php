<?php

namespace App\Http\Controllers\Admin;

use App\Filters\Entities\PostFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Services\PostService;
use App\Services\TagService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(PostFilter $filter): \Illuminate\Contracts\View\View
    {
        return view('admin.post.index')->with([
            'posts' => Post::filter($filter)
                            ->latest()
                            ->paginate(20),
        ]);
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('admin.post.create')->with([
            'post' => new Post(),
            'tags' => collect([])
        ]);
    }

    public function edit(Post $post): \Illuminate\Contracts\View\View
    {
        return view('admin.post.edit')->with([
            'post' => $post,
            'tags' => $post->tags->pluck('name')
        ]);
    }

    public function store(PostRequest $request)
    {
        $post = PostService::store($request);

        $this->uploadImage($post, $request);

        TagService::sync($post, $request);

        return redirect()->route('admin.post.index')->withSuccess('ثبت پست با موفقیت انجام شد');
    }

    public function update(PostRequest $request, Post $post)
    {

        PostService::update($post, $request);

        $this->uploadImage($post, $request);

        TagService::sync($post, $request);

        return back()->withSuccess('ویرایش با موفقیت انجام شد');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response("پست با شناسه {$post->id} با موفقیت حذف شد", 200);
    }

    protected function uploadImage(Post $post, Request $request): void
    {
        if (! $image = $request->file('featured_image')) {
            return;
        }

        $image_name = time().'.'.$image->extension();
        $image->move(public_path('images/posts'), $image_name);
        $post->featured_image = $image_name;
        $post->save();
    }
}
