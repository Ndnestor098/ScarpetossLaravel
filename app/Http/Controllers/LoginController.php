<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("login.login");
    }


    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $user = Socialite::driver('google')->user();

        $authUser = User::where('google_id', $user->id)->first();

        if ($authUser) {
            Auth::login($authUser);
        } else {
            $existUser = User::where('email', $user->email)->first();

            if($existUser){
                return redirect()->back()->withErrors(['login_error' => 'El campo correo electrónico ya ha sido registrado.'])->withInput();
            }

            $authUser = User::create([
                'google_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);

            Auth::login($authUser);
            
        }
        
        return redirect()->route('home');
    }

    public function twitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function twitterCallback()
    {
        $user = Socialite::driver('twitter')->user();
        
        $authUser = User::where('twitter_id', $user->id)->first();

        if ($authUser) {
            Auth::login($authUser);
        } else {
            // Verifica si ya hay un usuario con el mismo correo electrónico
            $existUser = User::where('email', $user->email)->first();

            if ($existUser) {
                return redirect()->back()->withErrors(['login_error' => 'El campo correo electrónico ya ha sido registrado.'])->withInput();
            }

            $authUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'twitter_id' => $user->id,
            ]);

            Auth::login($authUser);
        }

        return redirect()->route('home');
    }

    public function github()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
        $user = Socialite::driver('github')->user();
        
        $authUser = User::where('github_id', $user->id)->first();

        if ($authUser) {
            Auth::login($authUser);
        } else {
            // Verifica si ya hay un usuario con el mismo correo electrónico
            $existUser = User::where('email', $user->email)->first();

            if ($existUser) {
                return redirect()->back()->withErrors(['login_error' => 'El campo correo electrónico ya ha sido registrado.'])->withInput();
            }

            $authUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'github_id' => $user->id,
            ]);

            Auth::login($authUser);
        }

        return redirect()->route('home');
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
            'password' => 'required|string|min:8',
            'terms' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return redirect(route("register"))->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

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
        return redirect(route("login"))->withErrors(['Las credenciales proporcionadas son incorrectas.'])->withInput();
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
