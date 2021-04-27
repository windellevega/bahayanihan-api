<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

//Worker Type constants
define('ALL_TYPES', -1);
define('NON_WORKERS', 0);
define('WORKERS', 1);

//Skill constant
define('ALL_SKILLS', 0);

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type = ALL_TYPES, $skill = ALL_SKILLS)
    {
        // if($type == ALL_TYPES) {
        //     $users = User::all();
        // }
        // else if($type == NON_WORKERS) {
        //     $users = User::where('is_worker', 0)
        //                 ->get();
        // }
        // else if($type == WORKERS) {
        //     if($skill == ALL_SKILLS) {
        //         $users = User::where('is_worker', 1)
        //                     ->get();
        //         $users->load('Skills');
        //     }
        //     else {
        //         $users = User::where('is_worker', 1)
        //                     ->whereHas('Skills', function($q) use ($skill) {
        //                         $q->where('skill_id', $skill);
        //                     })
        //                     ->get();
        //         $users->load('Skills');
        //     }
        // }
        // else {
        //     return response()->json([
        //         'error' => 'Invalid user type.'
        //     ]);
        // }

        switch($type) {
            case ALL_TYPES:
                $users = User::all();
                break;
            case NON_WORKERS:
                $users = User::where('is_worker', 0)
                            ->get();
                break;
            case WORKERS:
                if($skill == ALL_SKILLS) {
                    $users = User::where('is_worker', 1)
                                ->get();
                }
                else {
                    $users = User::where('is_worker', 1)
                                ->whereHas('skills', function($q) use ($skill) {
                                    $q->where('skill_id', $skill);
                                })
                                ->get();
                }

                $users->load('skills');
                break;
            default:
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
    public function store(RegisterUserRequest $request)
    {
        $user = User::create([
            'firstname'             => $request->firstname,
            'middlename'            => $request->middlename,
            'lastname'              => $request->lastname,
            'email_address'         => $request->email_address,
            'username'              => $request->username,
            'password'              => Hash::make($request->password),
            'address'               => $request->address,
            'current_long'          => $request->current_long,
            'current_lat'           => $request->current_lat,
            'is_worker'             => false,
            'profile_picture_url'   => './assets/profile_pictures/default.jpg',
            'mobile_number'         => $request->mobile_number,
        ]);

        $access_token = $user->createToken('BahayanihanAPI')->accessToken;

        return response()->json(['access_token' => $access_token]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user->load('skills'));
    }

    public function loggedInUserInfo()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    public function getUserRole()
    {
        $user = User::findOrFail(Auth::id(), ['is_worker']);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id); //replace with Auth::id();

        $user->firstname    = $request->firstname;
        $user->middlename   = $request->middlename;
        $user->lastname     = $request->lastname;
        $user->address      = $request->address;

        if(!Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->current_long         = $request->current_long;
        $user->current_lat          = $request->current_lat;
        $user->is_worker            = $request->is_worker;
        $user->profile_picture_url  = isset($request->profile_picture_url) ? $request->profile_picture_url : 'public/photos/profile/default.jpg';
        $user->mobile_number        = $request->mobile_number;

        $user->save();

        return response()->json([
            'message' => 'User information updated successfully.'
        ]);
    }

    public function updateLocation(UpdateLocationRequest $request)
    {
        $user = User::findOrFail(Auth::id()); //replace with Auth::id();

        $user->current_long = $request->current_long;
        $user->current_lat  = $request->current_lat;

        $user->save();

        return response()->json([
            'message' => 'User location updated successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
