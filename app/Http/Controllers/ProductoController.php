<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Talla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    const PAGINATION = 4;
    public function index(Request $request)
    {
        /*$buscarpor = $request->get('buscarpor');
        $producto=Producto::where('estado','=','1')->where('descripcion','like','%'.$buscarpor.'%')->paginate($this::PAGINATION);
        dd($producto->to);
        return view('producto.index',compact('producto','buscarpor'));*/
        $buscarpor = $request->get('buscarpor');

        $producto = DB::table('productos')
            ->join('categorias', 'productos.idcategoria', '=', 'categorias.idcategoria')
            ->join('tallas', 'productos.idtalla', '=', 'tallas.idtalla')
            ->select(
                'productos.idproducto as idproducto',
                'categorias.descripcion as categoria',
                'tallas.descripcion as talla',
                'productos.descripcion as descripcion',
                'productos.stock as stock',
                'productos.precio as precio'
            )
            ->where('productos.estado', '1')
            ->where('categorias.descripcion', 'like', "%$buscarpor%")
            ->get();

        return view('productos.index', compact('producto', 'buscarpor'));
    }

    public function create()
    {
        $categoria = Categoria::where('estado', '=', '1')->get();
        $talla = Talla::where('estado', '=', '1')->get();
        return view('productos.create', compact('categoria', 'talla'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'descripcion' => 'required|max:30'
        ], [
            'descripcion.required' => 'Ingrese descripción de Producto',
            'descripcion.max' => 'Máximo 40 caracteres para la descripción',
            'precio.required' => 'Ingrese precio de producto',
            'precio.min' => 'Precio no puede ser negatico',
            'stock.required' => 'Ingrese stock de producto',
            'stock.min' => 'Stock no puede ser negatico',
        ]);
        $producto = new Producto();
        $producto->descripcion = $request->descripcion;
        $producto->idcategoria = $request->idcategoria;
        $producto->idtalla = $request->idtalla;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->estado = '1';
        $producto->save();
        return redirect()->route('productos.index')->with('datos', 'Registro Nuevo Guardado...!');
    }


    public function show($id)
    {
        //
    }

    public function edit($idproducto)
    {
        $producto = Producto::findOrFail($idproducto);
        $categoria = Categoria::where('estado', '=', '1')->get();
        $talla = Talla::where('estado', '=', '1')->get();
        return view('productos.edit', compact('producto', 'categoria', 'talla'));
    }

    public function update(Request $request, $idproducto)
    {
        $data = $request->validate([
            'descripcion' => 'required|max:30'
        ], [
            'descripcion.required' => 'Ingrese descripción de Producto',
            'descripcion.max' => 'Máximo 40 caracteres para la descripción'
        ]);
        $producto = Producto::findOrFail($idproducto);
        $producto->descripcion = $request->descripcion;
        $producto->idcategoria = $request->idcategoria;
        $producto->idtalla = $request->idtalla;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->estado = '1';
        $producto->save();
        return redirect()->route('productos.index')->with('datos', 'Registro Actualizado Guardado...!');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->estado = '0';
        $producto->save();
        return redirect()->route('productos.index')->with('datos', 'Registro Eliminado...!');
    }
    public function confirmar($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.confirmar', compact('producto'));
    }
}
