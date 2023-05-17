<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Usuario;
use App\Models\Psicologo;
use App\Models\Cita;
use Illuminate\Support\Facades\Log;


class UsuarioController extends Controller
{
public function showRegisterForm()
{
    return view('register');
}

    // Función para registrar un usuario
public function register(Request $request)
{
    // Validar los datos de entrada
    $validator = Validator::make($request->all(), [
        'nombre' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'direccion' => 'required|string|max:255',
        'ciudad' => 'required|string|max:255',
        'codigo_postal' => 'required|string|max:255',
        'fecha_nacimiento' => 'required|date',
        'telefono' => 'required|string|max:255',
        'nombre_usuario' => 'required|string|max:255|unique:usuarios',
        'email' => 'required|string|email|unique:usuarios|max:255',
        'password' => 'required|string|min:8|confirmed',
        'foto_selfie' => 'required|image|max:2048',
        'foto_dni_anverso' => 'required|image|max:2048',
        'foto_dni_reverso' => 'required|image|max:2048',
    ]);

    // Si la validación falla, devolver un error
    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    // Crear un nuevo usuario
    $usuario = new Usuario([
        'nombre' => $request->input('nombre'),
        'apellidos' => $request->input('apellidos'),
        'direccion' => $request->input('direccion'),
        'ciudad' => $request->input('ciudad'),
        'codigo_postal' => $request->input('codigo_postal'),
        'fecha_nacimiento' => $request->input('fecha_nacimiento'),
        'telefono' => $request->input('telefono'),
        'nombre_usuario' => $request->input('nombre_usuario'),
        'email' => $request->input('email'),
        'contraseña' => bcrypt($request->input('password')),
    ]);

    // Guardar la imagen del selfie en la carpeta correspondiente
    $selfiePath = $request->file('foto_selfie')->store('public/storage/selfies');
    $usuario->foto_selfie = $selfiePath;

    // Guardar las imágenes del DNI en la carpeta correspondiente
    $dniAnversoPath = $request->file('foto_dni_anverso')->store('public/dni');
    $dniReversoPath = $request->file('foto_dni_reverso')->store('public/dni');
    $usuario->foto_dni_anverso = $dniAnversoPath;
    $usuario->foto_dni_reverso = $dniReversoPath;

    // Guardar el usuario en la base de datos
    $usuario->save();

    // Redirigir al usuario a la interfaz del usuario
    return view('login');
}

public function showLoginForm()
{
    return view('login');
}

public function login(Request $request)
{
    // Validar los datos de entrada
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    // Si la validación falla, redirigir de vuelta con los errores
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Intentar autenticar al usuario
    $user = Usuario::where('email', $request->input('email'))->first();
    if ($user && password_verify($request->input('password'), $user->contraseña))
    {
        // Autenticación exitosa, redirigir al usuario a la página principal
        Auth::login($user);
        return redirect()->route('usuario.index');
    }
    else
    {
        // Autenticación fallida, redirigir al usuario de vuelta con un mensaje de error
        return redirect()->back()->withErrors(['error' => 'Credenciales inválidas'])->withInput();
    }
}

public function index()
{
    $usuario = auth()->user();

    if ($usuario) {
        $nombre = $usuario->nombre;

        // Obtener la lista de psicólogos con sus respectivas reseñas
        $psicologos = Psicologo::all();

        return view('usuario.index', compact('nombre', 'psicologos'));
    } else {
        return redirect()->route('/');
    }
}

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}

public function reservarCita(Request $request)
{
    // Validar el formulario
    $request->validate([
        'fecha' => 'required|date',
        'hora' => 'required',
        'duracion' => 'required|in:30,60'
    ]);

    // Crear una nueva cita
    $cita = new Cita();
    $cita->id_usuario = Auth::user()->id;
    $cita->id_psicologo = $request->input('psicologo_id');
    $cita->fecha_cita = $request->input('fecha') . ' ' . $request->input('hora');
    $cita->duracion_cita = $request->input('duracion');
    $cita->estado = 'pendiente';
    $cita->save();

    // Redirigir a la página de citas
    return redirect()->route('usuario.Vistacitas');
}

public function citas()
{
    // Obtener las citas del usuario actual con los datos del psicólogo
    $citas = Cita::where('id_usuario', auth()->user()->id)
                 ->with('psicologo')
                 ->get();

    // Pasar las citas a la vista
    return view('usuario.Vistacitas', compact('citas'));
}

}
