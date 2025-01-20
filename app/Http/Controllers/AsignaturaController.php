<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    /**
     * GET /asignaturas
     * Muestra el listado de todas las asignaturas, incluyendo relaciones si se desea.
     */
    public function index()
    {
        // Ejemplo de cargar relaciones con profesor y alumnos
        return response()->json(Asignatura::with(['profesor', 'alumnos'])->get(), 200);
    }

    /**
     * GET /asignaturas/{id}
     * Muestra una asignatura concreta por su ID.
     */
    public function show($id)
    {
        $asignatura = Asignatura::with(['profesor', 'alumnos'])->findOrFail($id);
        return response()->json($asignatura, 200);
    }

    /**
     * POST /asignaturas
     * Crea una nueva asignatura.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|max:255',
            'profesor_id' => 'required|exists:profesores,id'
        ]);

        $asignatura = Asignatura::create($request->all());
        return response()->json($asignatura, 201);
    }

    /**
     * PUT /asignaturas/{id}
     * Actualiza los datos de una asignatura.
     */
    public function update(Request $request, $id)
    {
        $asignatura = Asignatura::findOrFail($id);

        $request->validate([
            'nombre'      => 'sometimes|required|max:255',
            'profesor_id' => 'sometimes|required|exists:profesores,id'
        ]);

        $asignatura->update($request->all());
        return response()->json($asignatura, 200);
    }

    /**
     * DELETE /asignaturas/{id}
     * Elimina una asignatura por su ID.
     */
    public function destroy($id)
    {
        $asignatura = Asignatura::findOrFail($id);
        $asignatura->delete();
        return response()->json(null, 204);
    }
}
