<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Turismo;


class TurismoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $turismos=Turismo::all();

        return view('turismos.index', compact('turismos'));
    }

    public function mapa()
    {
        //Consulat de clientes en la BDD
        $turismos=Turismo::all();

        //REnder la vista y pasar datos
        return view('turismos.mapa',compact('turismos'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('turismos.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required',
            'categoria' => 'required|string|max:255',
            'imagenes' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'latitud' => 'required',
            'longitud' => 'required',
        ]);

        // Guardar la imagen
        if ($request->hasFile('imagenes')) {
            $imagen = $request->file('imagenes');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $rutaImagen = $imagen->storeAs('imgTurismo', $nombreImagen, 'public');
        } else {
            $rutaImagen = null;
        }

        // Crear el sitio turístico
        Turismo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
            'imagenes' => $rutaImagen, // Guarda la ruta del archivo, no la URL directa
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
        ]);

        return redirect()->route('turismos.index')->with('success', 'Sitio turístico registrado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $turismo = Turismo::findOrFail($id);

        return view('turismos.editar', compact('turismo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required',
            'categoria' => 'required|string|max:255',
            'imagenes' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
        ]);

        $turismo = Turismo::findOrFail($id);

        // Actualizar datos básicos
        $turismo->nombre = $request->nombre;
        $turismo->descripcion = $request->descripcion;
        $turismo->categoria = $request->categoria;
        $turismo->latitud = $request->latitud;
        $turismo->longitud = $request->longitud;

        // Si se carga una nueva imagen, reemplazar la anterior
        if ($request->hasFile('imagenes')) {
            $imagen = $request->file('imagenes');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $rutaImagen = $imagen->storeAs('imgTurismo', $nombreImagen, 'public');
            $turismo->imagenes = $rutaImagen;
        }

        $turismo->save();

        return redirect()->route('turismos.index')->with('success', 'Sitio turístico actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $turismo = Turismo::findOrFail($id);
        $turismo->delete();
        return redirect()->route('turismos.index')->with('success', 'Atraccion eliminada correctamente.');
    }
}
