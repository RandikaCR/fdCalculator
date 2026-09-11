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
    public function index(Request $request)
    {
        $userAccess = isSuperAdmin();

        $keyword = !empty($request->keyword) ? $request->keyword : null;
        $records = User::select('users.*')
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where('users.name', 'like', "%$keyword%")
                    ->orWhere('users.email', 'like', "%$keyword%");
            })
            ->when(!empty(!isSuperAdmin()), function ($query) {
                return $query->where('users.user_role_id', '!=', 1);
            })
            // ->where('users.id', '!=', 1)
            ->orderBy('users.id', 'ASC')
            ->paginate(20)
            ->withQueryString();

        return view('backend.users.index',[
            'records' => $records,
            'keyword' => $keyword,
            'user_access' => $userAccess,
        ]);
    }

    public function get(Request $request){
        $req = $request->all();
        $id = !empty($req['id']) ? $req['id'] : 0;


        if (!empty($id)){
            $get = User::find($id);
            $status = 'success';

        }else{
            $status = 'error';
        }


        $out = [
            'status' => $status,
            'id' => $id,
            'name' => $get->name,
            'email' => $get->email,
            'user_role_id' => $get->user_role_id,
        ];
        return response()->json($out);

    }

    public function store(Request $request){
        $req = $request->all();
        $id = !empty($req['id']) ? $req['id'] : 0;

        $userAccess = isSuperAdmin();
        if (empty($userAccess)){
            return response()->json($this->userAccessDeniedMessage(), 422);
        }

        $validator = 1;

        if ($validator){

            if (!empty($id)){
                $validator = $request->validate([
                    'name' => ['required'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $id],
                    'user_role_id' => ['required'],
                ]);

                $save = User::find($id);
            }
            else{


                $validator = $request->validate([
                    'name' => ['required'],
                    'user_role_id' => ['required'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                    'password' => ['required', Rules\Password::defaults()],
                ]);

                $save = New User();
                $save->password = Hash::make($request->password);
                $save->image = 'user.png';
                $save->status = 1;
            }

            $save->name = $req['name'];
            $save->email = $req['email'];
            $save->user_role_id = $req['user_role_id'];
            $save->save();
            $status = 'success';
            $messageTitle = 'Success';
            $messageText = 'User saved';
        }else{

            $status = 'error';
            $messageTitle = 'Error!';
            $messageText = 'User already exist!';
        }


        $out = [
            'status' => $status,
            'message_title' => $messageTitle,
            'message_text' => $messageText,
        ];
        return response()->json($out);

        /*if ($response->successful()) {
            $rdata = $response->json();
            if (!empty($rdata)) {
                return response()->json($rdata);
            }
        } else if ($response->status() == 400) {
            return response()->json($response->json(), 422);
        } else if ($response->status() == 401) {
            return response()->json($response->json(), 401);
        }*/
    }

    public function status(Request $request){
        $req = $request->all();
        $id = !empty($req['id']) ? $req['id'] : 0;

        $text = '';
        $class = '';

        if (!empty($id)){
            $get = User::find($id);

            if ($get->status == 1){
                $get->status = 0;
            }else {
                $get->status = 1;
            }
            $get->save();
            $status = 'success';
            $get = User::find($id);
            $getStatus = commonStatus($get->status);
            $text = $getStatus['text'];
            $class = $getStatus['class'];

        }else{
            $status = 'error';
        }


        $out = [
            'status' => $status,
            'text' => $text,
            'class' => $class,
        ];
        return response()->json($out);

    }


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
