<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("login.login");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("login.register");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'accepted',
        ]);

        if ($validator->fails()) {
            // Validación fallida
            return redirect(route("register"))->withErrors($validator);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::attempt($user);
        $request->session()->regenerate();

        $request->session()->regenerate();
        return redirect(route("home"));
    }

    /**
     * Display the specified resource.
     */
    public function login(Request $request)
    {
        // Validar los datos del formulario de inicio de sesión
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            // Validación fallida
            return redirect(route("register"))->withErrors($validator);
        }

        // Intentar autenticar al usuario y establecer la cookie "remember me"
        $credentials = $request->only('email', 'password');
        $remember = ($request->filled('remember') ? true : false);

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Autenticación exitosa
            return redirect(route("home"));
        }
        
        // Si el inicio de sesión falla, redirigir de vuelta al formulario de inicio de sesión con un mensaje de error
        return redirect(route("login"))->with('errors', 'Las credenciales proporcionadas son incorrectas.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect(route("home"));
    }
}
