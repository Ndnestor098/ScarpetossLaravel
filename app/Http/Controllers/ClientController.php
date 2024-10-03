<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("client.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function details()
    {
        return view("client.edit");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function editUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            // Validación fallida
            return redirect()->back()->withErrors(['errors' => 'La clave debe tener min. 8 caracteres.']);
        }

        if(Hash::check($request->password, auth()->user()->password)){
            $user = User::find(auth()->user()->id);

            if($request->address > 0){
                $user->name = $request->name;
                $user->address = $request->address;
                $user->save();

            }else{
                return redirect()->back()->withErrors(['errors' => 'Error en la direccion.']);
            }

        }else{
            return redirect()->back()->withErrors(['errors' => 'La clave no es la misma.']);
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function editPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'password_new' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            // Validación fallida
            return redirect()->back()->withErrors(['errorPassword' => $validator->errors()->get("password_new")]);
        }

        $user = User::find(Auth::user()->id);

        if (Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->password_new);
            $user->save();

            $request->session()->regenerate();
            return redirect()->back()->withErrors(['errorPassword' => '']);
        }else{
            return redirect()->back()->withErrors(['errorPassword' => 'La contraseña actual es incorrecta.']);
        }

    }

    
}
