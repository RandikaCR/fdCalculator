<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsersController extends Controller
{
    public function myProfile(Request $request){
        $user = User::find(Auth::user()->id);
        return view('backend.users.profile', ['user' => $user]);
    }

    public function saveMyProfilePersonal(Request $request){
        $user = User::find(Auth::user()->id);

        if (!empty($request->mode)){

            if ($request->mode == 'personal'){
                $request->validate([
                    'name' => 'required',
                ]);

                $user->name = $request->name;
                $user->save();
            }

            if ($request->mode == 'security'){
                $request->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                    'current_password' => ['required', 'current_password'],
                ]);

                $user->password = Hash::make($request->password);
                $user->save();
            }
        }

        $out = ['status' => 'success'];
        return response()->json($out);
    }
}
