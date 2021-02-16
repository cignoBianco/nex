<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Comment;
use Illuminate\Http\Request;

use SKONIKS\Centrifugo\Centrifugo;


class CommentController extends BaseController
{

    public function _function(){
        // declare Centrifugo
        $centrifugo = new Centrifugo();

        // generating token example
        $current_time = time();
        $user_id = '1234567890';
        $token = Centrifugo::token($user_id, $current_time, 'custom info');

        // publishing example
        $centrifugo->publish("channel" , ["custom data"]);

        // list of awailible methods:
        $response = $centrifugo->publish($channel, $data);
        $response = $centrifugo->unsubscribe($channel, $user_id);
        $response = $centrifugo->disconnect($user_id);
        $response = $centrifugo->presence($channel);
        $response = $centrifugo->history($channel);
        $response = $centrifugo->channels();
        $response = $centrifugo->stats();
        $response = $centrifugo->node();
        $token = Centrifugo::token($user_id, $timestamp, $info);

        // $response == false | when error
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $comments = auth()->user()->comments;

        return response()->json([
            'success' => true,
            'data' => $comments
        ]);
    }


    public function getAllComments()
    {
        $comments = Comment::all();//::latest()->paginate(50);

        return response()->json([
            'status' => 'ok',
            'comments' => $comments,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'post_id' => 'required'
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->post_id = $request->post_id;

        if (auth()->user()->comments()->save($comment))
        {
            return response()->json([
                'success' => true,
                'data' => $comment->toArray()
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Comment not added'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'post_id' => 'required'
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->post_id = $request->post_id;

        if (auth()->user()->comments()->save($comment))
        {
            return response()->json([
                'success' => true,
                'data' => $comment->toArray()
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Comment not added'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $comment = auth()->user()->comments()->find($id);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Comment not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $comment->toArray()
        ], 400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $comment = auth()->user()->comments()->find($id);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Comment not found '
            ], 400);
        }

        $updated = $comment->fill($request->all())->save();

        if ($updated)
        {
            return response()->json([
                'success' => true
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Comment can not be updated'
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment)
    {
        $comment = auth()->user()->comments()->find($id);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Comment not found '
            ], 400);
        }

        if ($comment->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Comment can not be deleted'
            ], 500);
        }
    }
}
