<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $req = Request::create(route('passport.token'), 'POST', [
            'grant_type' => 'password',
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
        ]);
        $response = app()->handle($req);
        return $response;
        // $http = new \GuzzleHttp\Client;
        // try {
        //     $response = $http->post(config('services.passport.login_endpoint'), [
        //         'form_params' => [
        //             'grant_type' => 'password',
        //             'client_id' => config('services.passport.client_id'),
        //             'client_secret' => config('services.passport.client_secret'),
        //             'username' => $request->username,
        //             'password' => $request->password,
        //         ],
        //     ]);
        //     return $response->getBody();
        // } catch (\GuzzleHttp\Exception\BadResponseException $e) {
        //     if ($e->getCode() === 400) {
        //         return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
        //     } else if ($e->getCode() === 401) {
        //         return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
        //     }
        //     return response()->json('Something went wrong on the server.', $e->getCode());
        // }
    }
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user,
        ]);
    }
    public function refresh()
    {

        return response([
            'status' => 'success',
        ]);
    }
    public function logout()
    {

        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json(['message' => 'Successfully logged out']);

    }
}
