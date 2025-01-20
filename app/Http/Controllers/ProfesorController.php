<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    /**
     * GET /profesores
     * Muestra listado de todos los profesores.
     */
    public function index()
    {
        return response()->json(Profesor::all(), 200);
    }

    /**
     * GET /profesores/{id}
     * Muestra un profesor por su ID.
     */
    public function show($id)
    {
        $profesor = Profesor::findOrFail($id);
        return response()->json($profesor, 200);
    }

    /**
     * POST /profesores
     * Crea un nuevo profesor.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'email'  => 'required|email|unique:profesores'
        ]);

        $profesor = Profesor::create($request->all());
        return response()->json($profesor, 201);
    }

    /**
     * PUT /profesores/{id}
     * Actualiza los datos de un profesor.
     */
    public function update(Request $request, $id)
    {
        $profesor = Profesor::findOrFail($id);

        // Validamos solo los campos que vengan en la petición.
        $request->validate([
            'nombre' => 'sometimes|required|max:255',
            'email'  => 'sometimes|required|email|unique:profesores,email,' . $id
        ]);

        $profesor->update($request->all());
        return response()->json($profesor, 200);
    }

    /**
     * DELETE /profesores/{id}
     * Elimina un profesor por su ID.
     */
    public function destroy($id)
    {
        $profesor = Profesor::findOrFail($id);
        $profesor->delete();
        // Devolvemos código 204 indicando que se ha eliminado correctamente.
        return response()->json(null, 204);
    }
}
