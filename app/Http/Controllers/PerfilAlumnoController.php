<?php

namespace App\Http\Controllers;

use App\Models\PerfilAlumno;
use App\Models\Alumno;
use Illuminate\Http\Request;

class PerfilAlumnoController extends Controller
{
    /**
     * Mostrar el perfil de un alumno específico.
     */
    public function show($id)
    {
        $perfil = PerfilAlumno::where('alumno_id', $id)->first();

        if (!$perfil) {
            return response()->json([
                'message' => 'Perfil no encontrado para el alumno especificado.'
            ], 404);
        }

        return response()->json($perfil, 200);
    }

    /**
     * Crear un nuevo perfil para un alumno.
     */
    public function store(Request $request, $id)
    {
        // Verificar que el alumno existe
        $alumno = Alumno::find($id);
        if (!$alumno) {
            return response()->json([
                'message' => 'Alumno no encontrado.'
            ], 404);
        }

        // Validar los datos de entrada
        $validated = $request->validate([
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
        ]);

        // Crear el perfil
        $perfil = PerfilAlumno::create([
            'alumno_id' => $id,
            'direccion' => $validated['direccion'],
            'telefono' => $validated['telefono'],
        ]);

        return response()->json([
            'message' => 'Perfil creado con éxito.',
            'perfil' => $perfil,
        ], 201);
    }

    /**
     * Actualizar el perfil de un alumno.
     */
    public function update(Request $request, $id)
    {
        $perfil = PerfilAlumno::where('alumno_id', $id)->first();

        if (!$perfil) {
            return response()->json([
                'message' => 'Perfil no encontrado.'
            ], 404);
        }

        // Validar los datos de entrada
        $validated = $request->validate([
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
        ]);

        // Actualizar el perfil
        $perfil->update($validated);

        return response()->json([
            'message' => 'Perfil actualizado con éxito.',
            'perfil' => $perfil,
        ], 200);
    }

    /**
     * Eliminar el perfil de un alumno.
     */
    public function destroy($id)
    {
        $perfil = PerfilAlumno::where('alumno_id', $id)->first();

        if (!$perfil) {
            return response()->json([
                'message' => 'Perfil no encontrado.'
            ], 404);
        }

        $perfil->delete();

        return response()->json([
            'message' => 'Perfil eliminado con éxito.'
        ], 200);
    }
}
