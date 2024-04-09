<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CommentStatus;
use App\Enums\CommentType;
use App\Filters\Entities\CommentFilter;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(CommentFilter $filter) {

        if (! request()->status) {
            request()->merge([
                'status' => 1
            ]);
        }

        $query = Comment::filter($filter)->with(['commentable']);



        $comments = $query->orderBy('status', 'asc')
        ->latest('created_at')
        ->get();

        return view('admin.comment.index')->with([
            'comments' => $comments,
            'showChildren' => false,
            'showReply' => true
        ]);
    }

    public function create()
    {
        return view('admin.comment.create', [
            'courses' => Course::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'user_id' => 'required_without:fname',
            'fname' => 'required_without:user_id',
            'rating' => 'required',
            'body' => 'required'
        ]);

        Comment::create([
           'commentable_id' => $request->course_id,
           'commentable_type' => 'App\Models\Course',
            'user_id' => $request->user_id ?: 2,
            'rating' => $request->rating,
            'fname' => $request->fname,
            'body' => $request->body,
            'status' => CommentStatus::ACTIVE,
            'type' => CommentType::REVIEW
        ]);

        return back()->with('success', 'دیدگاه با موفقیت ذخیره شد');
    }

    public function update(Comment $comment, Request $request) {
        request()->validate([
            'status' => ['required', 'int']
        ]);

        $comment->status = CommentStatus::from($request->status);
        $comment->save();

        return response(['message' => 'تغییرات با موفقیت اعمال شد'], 200);
    }

    public function destroy(Comment $comment) {
        $comment->allChildren()->delete();
        $comment->delete();

        session()->flash('success', 'دیدگاه با موفقیت حذف شد');

        return response(['message' => 'دیدگاه با موفقیت حذف شد'], 200);
    }
}
