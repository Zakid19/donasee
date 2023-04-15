<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return response()->json(['Message' => 'Berhasil masuk halaman register'],201);
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            // 'api_token' => Str::random(80),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        event(new Registered($user));

        Auth::login($user);

        if ($user->role_id == '1') {
            return response()->json([
                'admin' => true,
                'date' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ], 201);

        } elseif ($user) {
            return response()->json([
                'donatur' => true,
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ], 201);
        }

        return response()->json([
            'success' => false,
        ], 409);

        // if ($user->role_id == '1') {
        //     return redirect(RouteServiceProvider::ADMIN);
        // }

        // return redirect(RouteServiceProvider::HOME);
    }
}
