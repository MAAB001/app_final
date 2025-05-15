<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register'); // Vista de registro
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validación de datos
        $request->validate([
            'name' => ['required', 'string', 'max:255'], // Nombre es requerido, pero no es necesario para el login
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'rol' => ['required', 'in:admin,empleado'], // Validación para rol
        ]);

        // Crear el usuario con solo el rol, correo y contraseña
        User::create([
            'name' => $request->name, // Puedes dejar este campo si lo quieres guardar, aunque no es estrictamente necesario para login
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol, // Guardar el rol
        ]);

        // Redirigir a la vista de login con un mensaje de éxito
        return redirect()->route('login')->with('success', '¡Registro exitoso! Ahora puedes iniciar sesión.');
    }
}
