<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'message' => 'test'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'address_lat' => 'numeric|nullable',
            'address_long' => 'numeric|nullable',
            'is_worker' => 'required|boolean',
            'mobile_number' => 'numeric|regex:/(09)[0-9]{9}/',
            'email_address' => 'email|unique:users,email_address',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->all());
        }

        $user = User::create([
            'firstname' => $request['firstname'],
            'middlename' => $request['middlename'],
            'lastname' => $request['lastname'],
            'email_address' => $request['email_address'],
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
            'address_long' => $request['address_long'],
            'address_lat' => $request['address_lat'],
            'is_worker' => $request['is_worker'],
            'profile_picture_url' => isset($request->profile_picture_url) ? $request->profile_picture_url : 'public/photos/profile/default.jpg',
            'mobile_number' => $request['mobile_number'],
        ]);

        $success['token'] = $user->createToken('BahayanihanAPI')->accessToken;

        return response()->json(['success' => $success]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
