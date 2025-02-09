<?php

namespace App\Http\Controllers;

use App\Models\CabeceraVenta;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $fecha = $request->input('fecha', Carbon::today()->toDateString());
        $categoria_id = $request->input('categoria_id');

        $ventas_diarias = CabeceraVenta::whereDate('fecha_venta', $fecha)->sum('total');

        $ventas_totales = CabeceraVenta::sum('total');

        $ventas_categoria = CabeceraVenta::join('detalleventas', 'detalleventas.venta_id', '=', 'cabeceraventas.venta_id')
            ->join('productos', 'productos.idproducto', '=', 'detalleventas.producto_id')
            ->join('categorias', 'categorias.idcategoria', '=', 'productos.idcategoria')
            ->when($categoria_id, function ($query) use ($categoria_id) {
                return $query->where('categorias.idcategoria', $categoria_id);
            })
            ->whereDate('cabeceraventas.fecha_venta', $fecha)
            ->selectRaw('categorias.descripcion as categoria, SUM(detalleventas.cantidad * detalleventas.precio) as monto')
            ->groupBy('categorias.descripcion')
            ->get();

        $ventas_tipo = CabeceraVenta::join('detalleventas', 'detalleventas.venta_id', '=', 'cabeceraventas.venta_id')
            ->join('tipo', 'tipo.tipo_id', '=', 'cabeceraventas.tipo_id')
            ->selectRaw('tipo.descripcion as tipo, SUM(cabeceraventas.total) as total_ventas')
            ->whereDate('cabeceraventas.fecha_venta', $fecha)
            ->groupBy('tipo.descripcion')
            ->get();

        $producto_mas_solicitado = CabeceraVenta::join('detalleventas', 'detalleventas.venta_id', '=', 'cabeceraventas.venta_id')
            ->join('productos', 'productos.idproducto', '=', 'detalleventas.producto_id')
            ->selectRaw('productos.descripcion, SUM(detalleventas.cantidad) as cantidad')
            ->groupBy('productos.idproducto', 'productos.descripcion')
            ->orderByDesc('cantidad')
            ->first();

        if (!$producto_mas_solicitado) {
            $producto_mas_solicitado = (object) [
                'descripcion' => 'No hay productos vendidos',
                'cantidad' => 0
            ];
        }

        $categorias = Categoria::all();

        $tallas_mas_vendidas = CabeceraVenta::join('detalleventas', 'detalleventas.venta_id', '=', 'cabeceraventas.venta_id')
            ->join('productos', 'productos.idproducto', '=', 'detalleventas.producto_id')
            ->join('tallas', 'tallas.idtalla', '=', 'productos.idtalla')
            ->selectRaw('tallas.descripcion as talla, SUM(detalleventas.cantidad) as cantidad')
            ->groupBy('tallas.descripcion')
            ->orderByDesc('cantidad')
            ->get();

        $mes_mas_ventas = CabeceraVenta::selectRaw('MONTH(fecha_venta) as mes, SUM(total) as total_ventas')
            ->groupBy('mes')
            ->orderByDesc('total_ventas')
            ->first();

        return view('dashboard', compact('ventas_diarias', 'ventas_totales', 'ventas_categoria', 'producto_mas_solicitado', 'ventas_tipo', 'categorias', 'tallas_mas_vendidas', 'mes_mas_ventas'));

    }
}
