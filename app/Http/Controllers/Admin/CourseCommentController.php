<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseCommentController extends Controller
{
    public function index(Course $course)
    {
        $comments = $course->allCommentsWithChildren();

        return view('admin.comment.index')->with([
            'comments' => $comments,
            'showChildren' => true,
            'showReply' => false,
        ]);
    }
}
