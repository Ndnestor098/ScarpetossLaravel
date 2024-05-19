<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
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
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            // Validación fallida
            return Redirect::back()->withErrors(['errorname' => 'La clave debe tener min. 8 caracteres.']);
        }

        // Buscar al usuario por su ID
        $credentials = $request->only('name', 'password');

        if(Hash::check($credentials['password'], auth()->user()->password)){
            $user = auth()->user();

            if($request->address > 0){
                $user->name = $request->name;
                $user->address = $request->address;
                $user->save();

            }else{
                return Redirect::back()->withErrors(['errorname' => 'Error en la direccion.']);
            }

        }else{
            return Redirect::back()->withErrors(['errorname' => 'La clave no es la misma.']);
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function editPassword(Request $request)
    {
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'confirmed' => 'Las claves nuevas no coinciden.',
        ];  

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'password_new' => 'required|string|min:8|confirmed',
        ], $messages);

        if ($validator->fails()) {
            // Validación fallida
            return Redirect::back()->withErrors(['errorpassword' => $validator->errors()->get("password_new")]);
        }

        $user = Auth::user();

        if (Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->nueva_contraseña);
            $user->save();

            $request->session()->regenerate();
            return Redirect::back()->withErrors(['errorpassword' => '']);
        }else{
            return Redirect::back()->withErrors(['errorpassword' => 'La contraseña actual es incorrecta.']);
        }

    }

    
}
