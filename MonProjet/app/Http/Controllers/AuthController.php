<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'name'=>'required',
            'email'=>'required|email:rfc,dns|unique:users,email',
            'password'=>'required|confirmed|min:8',
            
        ]);

        $token = Str::random(64); // token unique pour la vérification
        //dd($token);

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> $request->password,
            // 'verify_token'=> $token,
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Incorrect email or password');
        }

        if (!$user->is_verified) {
            return back()->with('error', 'You must verify your email before logging in.');
        }

        // Connecter l'utilisateur
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Successfully connected');
    }
    
}
