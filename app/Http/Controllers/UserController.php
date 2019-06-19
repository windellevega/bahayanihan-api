<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

//Worker Type constants
define('ALL_TYPES', -1);
define('NON_WORKERS', 0);
define('WORKERS', 1);

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type = ALL_TYPES)
    {
        if($type == ALL_TYPES) {
            $users = User::all();
        }
        else if($type == NON_WORKERS) {
            $users = User::where('is_worker', 0)
                        ->first();
        }
        else if($type == WORKERS) {
            $users = User::where('is_worker', 1)
                        ->first();
        }
        else {
            return response()->json([
                'error' => 'Invalid user type.'
            ]);
        }

        if(!$users) {
            return response()->json([
                'error' => 'No users found.'
            ]);
        }

        return response()->json($users);
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
            'address' => 'required',
            'current_lat' => 'numeric|required',
            'current_long' => 'numeric|required',
            'is_worker' => 'required|boolean',
            'mobile_number' => 'numeric|regex:/(09)[0-9]{9}/',
            'email_address' => 'email|unique:users,email_address',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->all());
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'email_address' => $request->email_address,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'current_long' => $request->current_long,
            'current_lat' => $request->current_lat,
            'is_worker' => $request->is_worker,
            'profile_picture_url' => isset($request->profile_picture_url) ? $request->profile_picture_url : 'public/photos/profile/default.jpg',
            'mobile_number' => $request->mobile_number,
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
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'password' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'current_lat' => 'numeric|required',
            'current_long' => 'numeric|required',
            'is_worker' => 'required|boolean',
            'mobile_number' => 'numeric|regex:/(09)[0-9]{9}/',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->all());
        }

        $user = User::find($id); //replace with Auth::id();

        if(!$user) {
            return response()->json([
                'error' => 'User not found.'
            ]);
        }

        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->address = $request->address;

        if(!Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->current_long = $request->current_long;
        $user->current_lat = $request->current_lat;
        $user->is_worker = $request->is_worker;
        $user->profile_picture_url = isset($request->profile_picture_url) ? $request->profile_picture_url : 'public/photos/profile/default.jpg';
        $user->mobile_number = $request->mobile_number;

        $user->save();

        return response()->json([
            'message' => 'User information updated successfully.'
        ]);
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
