<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Blacklist;
use Illuminate\Http\Request;

class BlacklistsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $blockedUsers = auth()->user()->blocked;

        return response()->json([
            'success' => true,
            'data' => $blockedUsers
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
            'blocked_id' => 'required',
            'user_id' => 'required'
        ]);

        $blockedUser = new Blacklist();
        $blockedUser->blocked_id = $request->blocked_id;
        $blockedUser->user_id = auth()->user();

        if (auth()->user()->blocked()->save($blockedUser))
        {
            return response()->json([
                'success' => true,
                'data' => $blockedUser->toArray()
            ], 500);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => "This user wasn't add to blacklist"
            ], 501);
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
            'blocked_id' => 'required',
            'user_id' => 'required'
        ]);

        $blockedUser = new Blacklist();
        $blockedUser->blocked_id = $request->blocked_id;
        $blockedUser->user_id = auth()->user();

        if (auth()->user()->blocked()->save($blockedUser))
        {
            return response()->json([
                'success' => true,
                'data' => $blockedUser->toArray()
            ], 500);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => "This user wasn't add to blacklist"
            ], 501);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blacklist  $blacklist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currentUser = auth()->user();
        $blockedUsers =
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blacklist  $blacklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Blacklist $blacklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blacklist  $blacklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blacklist $blacklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blacklist  $blacklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blacklist $blacklist)
    {
        //
    }
}
