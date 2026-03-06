<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Verificar si ya existe un admin para mostrar un mensaje en la vista
        $adminExists = User::where('is_admin', true)->exists();
        
        return view('auth.register', compact('adminExists'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $adminExists = User::where('is_admin', true)->exists();
        $requestIsAdmin = $request->has('is_admin') && $request->is_admin == true;

        // Validación personalizada para administradores
        if ($requestIsAdmin && $adminExists) {
            return back()->withErrors([
                'is_admin' => 'Ya existe un administrador en el sistema. No puedes crear otro administrador.'
            ])->withInput();
        }

        // Si es el primer usuario del sistema, automáticamente será admin
        $isFirstUser = User::count() === 0;
        $isAdmin = $isFirstUser ? true : $requestIsAdmin;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'is_admin' => ['sometimes', 'boolean'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $isAdmin,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}