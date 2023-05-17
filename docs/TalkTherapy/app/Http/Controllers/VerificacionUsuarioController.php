<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VerificacionUsuario;

class VerificacionUsuarioController extends Controller
{
    /**
     * Muestra la lista de verificaciones de usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $verificaciones = VerificacionUsuario::all();
        return view('verificaciones.index', compact('verificaciones'));
    }

    /**
     * Muestra el formulario para crear una nueva verificación de usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('verificaciones.create');
    }

    /**
     * Almacena una nueva verificación de usuario en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'tipo_verificacion' => 'required',
            'estado' => 'required'
        ]);

        // Crear una nueva verificación de usuario
        $verificacion = new VerificacionUsuario();
        $verificacion->id_usuario = $request->id_usuario;
        $verificacion->tipo_verificacion = $request->tipo_verificacion;
        $verificacion->estado = $request->estado;
        $verificacion->save();

        // Redireccionar a la lista de verificaciones con un mensaje de éxito
        return redirect()->route('verificaciones.index')
            ->with('success', 'La verificación de usuario ha sido creada correctamente.');
    }

    /**
     * Muestra los detalles de una verificación de usuario específica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $verificacion = VerificacionUsuario::findOrFail($id);
        return view('verificaciones.show', compact('verificacion'));
    }

    /**
     * Muestra el formulario para editar una verificación de usuario específica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $verificacion = VerificacionUsuario::findOrFail($id);
        return view('verificaciones.edit', compact('verificacion'));
    }

    /**
     * Actualiza una verificación de usuario específica en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'tipo_verificacion' => 'required',
            'estado' => 'required'
        ]);

        // Buscar la verificación de usuario y actualizarla
        $verificacion = VerificacionUsuario::findOrFail($id);
        $verificacion->tipo_verificacion = $request->tipo_verificacion;
        $verificacion->estado = $request->estado;
        $verificacion->save();

        // Redireccionar a los detalles de la verificación actualizada con un mensaje de éxito
        return redirect()->route('verificaciones.show', $verificacion->id_verificacion)
            ->with('success', 'La verificación de usuario ha sido actualizada correctamente.');
    }
}
