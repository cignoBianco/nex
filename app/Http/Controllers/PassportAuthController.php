<?php

namespace App\Http\Controllers;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class PassportAuthController extends Controller
{
    /**
     * Registration
     * @mixin Eloquent
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Login
     * @mixin Eloquent
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * @mixin Eloquent
     * */
    public function update(Request $request, $userId)
    {
        $this->validate($request, [
            'password' => 'required|min:8',
        ]);

        $user = User::find($userId);

        $user->password = $request->password;

        if ($user->save()) {
            return response()->json(['status' => 'ok'], 200);
        } else {
            return response()->json(['status' => 'error'], 200);
        }
    }
}
