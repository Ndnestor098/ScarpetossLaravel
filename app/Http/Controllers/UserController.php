<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {   
        $data = User::paginate(20);

        return view("admin.users", ['data'=>$data]);
    }

    public function create(){
        return view('admin.create_users');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            // Validación fallida
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'is_admin' => true,
        ]);

        return redirect(route('admin.users'));
    }

    public function delete(Request $request)
    {
        $user = User::find(intval($request->id));
        $user->delete();

        return back();
    }
}
