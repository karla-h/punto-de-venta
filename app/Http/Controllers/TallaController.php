<?php

namespace App\Http\Controllers;

use App\Models\Talla;
use Illuminate\Http\Request;

class TallaController extends Controller
{
    const PAGINATION = 10;

    public function index()
    {
        $buscarpor = request()->get('buscarpor');
        $talla = Talla::where('estado', '=', '1')
            ->where('descripcion', 'like', '%' . $buscarpor . '%')
            ->paginate($this::PAGINATION);

        return view('tallas.index', compact('talla', 'buscarpor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tallas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate(
            ['descripcion' => 'required|max:5'],
            [
                'descripcion.required' => 'Ingrese descripción de talla',
                'descripcion.max' => 'Maximo 5 caracteres para la descripción'
            ]
        );

        $talla = new Talla();
        $talla->descripcion = $request->descripcion;
        $talla->estado = '1';
        $talla->save();
        return redirect()->route('tallas.index')->with('datos', 'Registro Nuevo Guardado...!');
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
        $talla = Talla::findOrFail($id);
        return view('tallas.edit', compact('talla'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = request()->validate(
            [
                'descripcion' => 'required|max:5'
            ],
            [
                'descripcion.required' => 'Ingrese descripción de talla',
                'descripcion.max' => 'Maximo 5 caracteres para la descripción'
            ]
        );

        $talla = Talla::findOrFail($id);
        $talla->descripcion = $request->descripcion;
        $talla->save();
        return redirect()->route('tallas.index')->with('datos', 'Registro Actualizado...!');
    }

    public function confirmar(string $id)
    {
        $talla = Talla::findOrFail($id);
        return view('tallas.confirmar', compact('talla'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $talla = Talla::findOrFail($id);
        $talla->estado = '0';
        $talla->save();
        return redirect()->route('tallas.index')->with('datos', 'Registro Eliminado...!');
    }
}
