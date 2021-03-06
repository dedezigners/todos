<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Question;
use Illuminate\Http\Request;
use App\Events\DeleteReplyEvent;
use App\Http\Resources\ReplyResource;
use App\Notifications\ReplyNotifications;

class ReplyController extends Controller
{
    /**
     * Create a new ReplyController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        // return $question;
        return ReplyResource::collection($question->replies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $this->validate($request, [
            'reply' => 'required'
        ]);
        
        $reply = $question->replies()->create([
            'reply' => $request->reply
        ]);
        
        if ($reply->user_id !== $question->user_id) {
            $user = $question->user;
            $user->notify(new ReplyNotifications($reply));
        }

        return response()->json(new ReplyResource($reply), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Reply $reply)
    {
        return new ReplyResource($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Reply $reply)
    {
        $this->validate($request, [
            'reply' => 'required'
        ]);

        $reply->update($request->all());

        return response()->json(new ReplyResource($reply), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        broadcast(new DeleteReplyEvent($reply->id))->toOthers();
        return response()->json(null, 204);
    }
}
