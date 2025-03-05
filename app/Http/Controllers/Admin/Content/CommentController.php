<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //change useen status to seen for new comments before returning the view
        $unseenComments = Comment::where('status', 0)->get();
        // hint : status = 0 : unseen  /  status = 1 : seen  / status = 2 : approved
        foreach ($unseenComments as $unseenComment) {
            $unseenComment->status = 1;
            $unseenComment->save();
        }

        $comments = Comment::orderByDesc('created_at')->paginate(10);
        return view('admin.content.comment.index', compact('comments'));
    }


    public function changeStatus(Comment $comment)
    {
        if ($comment->status == 1) {
            $comment->update(['status' => 2]);
            return to_route('admin.content.comment.index')->with('swal-success', 'نظر تایید شد');
        } else {
            $comment->update(['status' => 1]);
            // when comment's status changes to seen, it's answers should do the same
            foreach ($comment->answers as $answer) {
                $answer->update(['status' => 1]);
                // status for second answers will be changed like first answers to seen
                foreach ($answer->answers as $secondAnswer) {
                    $secondAnswer->update(['status' => 1]);
                }
            }
            return to_route('admin.content.comment.index')->with('swal-success', 'نظر و پاسخ های آن رد تایید شدند!');
        }
        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('admin.content.comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
