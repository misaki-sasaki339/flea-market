<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //コメント送信機能
    public function store(CommentRequest $request)
    {
        Comment::create(
            [
                'user_id' => auth()->id(),
                'item_id' => $request->item_id,
                'review' => $request->review,
            ]
        );
        return redirect()->back();
    }

    //コメント削除機能
    public function destroy() {}
}
