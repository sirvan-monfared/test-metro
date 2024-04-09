<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Podcast;

class PodcastCommentController extends Controller
{
    public function index(Podcast $podcast)
    {
        $comments = $podcast->allCommentsWithChildren();

        return view('admin.comment.index')->with([
            'comments' => $comments,
            'showChildren' => true,
            'showReply' => false,
        ]);
    }
}
