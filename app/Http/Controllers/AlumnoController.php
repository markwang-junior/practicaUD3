<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * GET /alumnos
     * Muestra listado de todos los alumnos.
     */
    public function index()
    {
        return response()->json(Alumno::all(), 200);
    }

    /**
     * GET /alumnos/{id}
     * Muestra un alumno por su ID.
     */
    public function show($id)
    {
        $alumno = Alumno::findOrFail($id);
        return response()->json($alumno, 200);
    }

    /**
     * POST /alumnos
     * Crea un nuevo alumno.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'email'  => 'required|email|unique:alumnos'
        ]);

        $alumno = Alumno::create($request->all());
        return response()->json($alumno, 201);
    }

    /**
     * PUT /alumnos/{id}
     * Actualiza los datos de un alumno.
     */
    public function update(Request $request, $id)
    {
        $alumno = Alumno::findOrFail($id);

        // Validamos solo los campos que vengan en la petición.
        $request->validate([
            'nombre' => 'sometimes|required|max:255',
            'email'  => 'sometimes|required|email|unique:alumnos,email,' . $id
        ]);

        $alumno->update($request->all());
        return response()->json($alumno, 200);
    }

    /**
     * DELETE /alumnos/{id}
     * Elimina un alumno por su ID.
     */
    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();
        return response()->json(null, 204);
    }
}
