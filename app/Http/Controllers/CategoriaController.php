<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ const PAGINATION = 10;
    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $categoria = Categoria::where('estado', '=', '1')->where('descripcion', 'like', '%' . $buscarpor . '%')->paginate($this::PAGINATION);
        return view('categorias.index', compact('categoria', 'buscarpor'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            ['descripcion' => 'required|max:20'],
            [
                'descripcion.required' => 'Ingrese descripción de categoria',
                'descripcion.max' => 'Maximo 20 caracteres para la descripción'
            ]
        );
        $categoria = new Categoria();
        $categoria->descripcion = $request->descripcion;
        $categoria->estado = '1';
        $categoria->save();
        return redirect()->route('categorias.index')->with('datos', 'Registro Nuevo Guardado...!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $data = request()->validate(
            [
                'descripcion' => 'required|max:30'
            ],
            [
                'descripcion.required' => 'Ingrese descripción de categoria',
                'descripcion.max' => 'Maximo 30 caracteres para la descripción'
            ]
        );
        $categoria = Categoria::findOrFail($id);
        $categoria->descripcion = $request->descripcion;
        $categoria->save();
        return redirect()->route('categorias.index')->with('datos', 'Registro Actualizado...!');
    }

    public function confirmar($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.confirmar', compact('categoria'));
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->estado = '0';
        $categoria->save();
        return redirect()->route('categorias.index')->with('datos', 'Registro Eliminado...!');
    }
}
