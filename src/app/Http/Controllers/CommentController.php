<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    // コメント送信機能
    public function store(CommentRequest $request)
    {
        Comment::create(
            [
                'user_id' => auth()->id(),
                'item_id' => $request->item_id,
                'review' => $request->review,
            ]
        );

        return redirect()->back()->with('flash_message', 'コメントを投稿しました')->with('flash_type', 'success');
    }
}
