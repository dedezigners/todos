<?php

namespace App\Http\Controllers;

use Auth;
use App\Like;
use App\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Create a new LikeController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function like(Reply $reply)
    {
        $reply->likes()->create([
            'user_id' => auth()->id()
        ]);
    }

    public function dislike(Reply $reply)
    {
        $reply->likes()->where('user_id', auth()->id())->first()->delete();
    }
}
