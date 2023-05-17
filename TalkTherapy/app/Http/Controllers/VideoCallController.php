<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoCallController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->role; // Obtén el valor de la variable role de la solicitud

        return view('videocall', compact('role')); // Pasa la variable role a la vista videocall.blade.php
    }
}
