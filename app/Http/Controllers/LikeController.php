<?php

namespace App\Http\Controllers;

use Auth;
use App\Like;
use App\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Reply $reply)
    {
        $reply->likes()->create([
            'user_id' => 1
        ]);
    }

    public function dislike(Reply $reply)
    {
        $reply->likes()->where('user_id', 1)->first()->delete();
    }
}
