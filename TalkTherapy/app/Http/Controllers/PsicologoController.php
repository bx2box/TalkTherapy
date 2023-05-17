<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Psicologo;
use App\Models\Usuario;
use App\Models\Cita;

class PsicologoController extends Controller
{
    //Función para mostrar el formulario de registro de psicologos
    public function showRegisterForm()
    {
        return view('registerP');
    }

    //Funcion para registrar a un psicologo
    public function registerP(Request $request)
    {
        // Valida los datos del formulario
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:10',
            'fecha_nacimiento' => 'required|date|before:today',
            'email' => 'required|string|email|max:255|unique:psicologos,email',
            'password' => 'required|string|min:8|max:255',
            'num_colegiado' => 'required|string|unique:psicologos,num_colegiado',
            'precio_sesion' => 'required|numeric|min:0|max:9999.99',
            'foto_selfie' => 'required|image|max:2048',
            'foto_dni_anverso' => 'required|image|max:2048',
            'foto_dni_reverso' => 'required|image|max:2048',
            'foto_diploma' => 'required|image|max:2048',
        ]);

        // Si la validación falla, redirigir de vuelta con los errores
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crea un nuevo objeto Psicologo con los datos del formulario
        $psicologo = new Psicologo([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'ciudad' => $request->input('ciudad'),
            'codigo_postal' => $request->input('codigo_postal'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'email' => $request->input('email'),
            'contraseña' => bcrypt($request->input('password')),
            'num_colegiado' => $request->input('num_colegiado'),
            'precio_sesion' => $request->input('precio_sesion'),
        ]);

        // Guardar la imagen del selfie en la carpeta correspondiente
        $selfiePath = $request->file('foto_selfie')->store('public/storage/selfies');
        $psicologo->foto_selfie = $selfiePath;

        // Guardar la imagen del diploma en la carpeta correspondiente
        $diplomaPath = $request->file('foto_diploma')->store('public/diplomas');
        $psicologo->foto_diploma = $diplomaPath;

        // Guardar las imágenes del DNI en la carpeta correspondiente
        $dniAnversoPath = $request->file('foto_dni_anverso')->store('public/dni');
        $dniReversoPath = $request->file('foto_dni_reverso')->store('public/dni');
        $psicologo->foto_dni_anverso = $dniAnversoPath;
        $psicologo->foto_dni_reverso = $dniReversoPath;

        // Guardar el nuevo objeto Psicologo en la base de datos
        $psicologo->save();

        // Redirigir al psicologo al login
        return view('loginP');
    }

    //Funcion para mostrar el formulario de login de psicologos
    public function showLoginForm()
    {
        return view('loginP');
    }

    //Funcion para que los psicologos inicien sesion
    public function loginP(Request $request)
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

        // Intentar autenticar al psicologo
        $psico = Psicologo::where('email', $request->input('email'))->first();
        if ($psico && password_verify($request->input('password'), $psico->contraseña))
        {
            // Autenticación exitosa, redirigir al psicologo a la página principal
            Auth::guard('psicologo')->login($psico);
            return redirect()->route('psicologo.index');
        }
        else
        {
            // Autenticación fallida, redirigir al psicologo de vuelta con un mensaje de error
            return redirect()->back()->withErrors(['error' => 'Credenciales inválidas'])->withInput();
        }
    }

    public function index()
    {
        // Obtener el ID del psicólogo actualmente autenticado
        $psicologoId = auth()->guard('psicologo')->user()->id;

        // Obtener las citas del psicólogo actual con los datos del usuario
        $citas = Cita::where('id_psicologo', $psicologoId)
                    ->with('usuario')
                    ->get();

        // Pasar las citas a la vista
        return view('psicologo.index', compact('citas'));
    }
}
