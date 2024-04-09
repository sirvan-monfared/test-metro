<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostCommentController extends Controller
{
    public function index(Post $post)
    {
        $comments = $post->allCommentsWithChildren();

        return view('admin.comment.index')->with([
            'comments' => $comments,
            'showChildren' => true,
            'showReply' => false,
        ]);
    }
}
