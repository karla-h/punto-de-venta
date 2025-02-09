<?php

namespace App\Http\Controllers;

use App\Models\CabeceraVenta;
use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\Parametro;
use App\Models\Tipo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    const PAGINATION = 10;
    public function index(Request $request)
    {
        $venta = CabeceraVenta::where('estado', '=', '1')->paginate($this::PAGINATION);
        return view('ventas.index', compact('venta'));
    }
    public function create()
    {
        $cliente = DB::table('clientes')->get();
        $producto = DB::table('productos')->get();
        $tipo = Tipo::all();
        $tipou = Tipo::select('tipo_id', 'descripcion')->orderBy('tipo_id', 'DESC')->get();
        $parametros = Parametro::findOrFail($tipou[0]->tipo_id);
        return view('ventas.create', compact('tipo', 'parametros', 'cliente', 'producto'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $cliente = Cliente::where('ruc_dni', '=', $request->ruc)->firstOrFail();
            $venta = new CabeceraVenta();
            $venta->cliente_id = $cliente->cliente_id;
            $venta->num_doc = $this->numeracion($request->seltipo);
            $venta->tipo_id = $request->seltipo;
            $venta->fecha_venta = Carbon::createFromFormat('d/m/Y', $request->fecha)->format('Y-m-d');

            if ($request->seltipo === '2') {
                $venta->total = $request->total;
                $venta->subtotal = 0;
                $venta->igv = 0;
            } else {
                $venta->total = $request->total;
                $venta->subtotal = $request->total - ($request->total * 0.18);
                $venta->igv = $request->total * 0.18;
            }

            $venta->estado = '1';
            $venta->save();

            foreach ($request->detallesventa as $det) {
                DetalleVenta::create([
                    'venta_id' => $venta->venta_id,
                    'producto_id' => $det['idproducto'],
                    'cantidad' => $det['cantidad'],
                    'precio' => $det['precio'],
                ]);

                $producto = DB::table('productos')->where('idproducto', $det['idproducto'])->first();
                if ($producto) {
                    $nuevoStock = $producto->stock - $det['cantidad'];
                    DB::table('productos')->where('idproducto', $det['idproducto'])->update(['stock' => $nuevoStock]);
                }
            }
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Venta registrada exitosamente.']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Hubo un error al registrar la venta. Inténtalo nuevamente.']);
        }
    }

    public function dar_formato($numero)
    {
        if ($numero < 10) return "0000" . $numero;
        else if ($numero < 100) return "000" . $numero;
        else if ($numero < 1000) return "00" . $numero;
        else if ($numero < 10000) return "0" . $numero;
        else return '' . $numero;
    }

    public function numeracion($tipo_id)
    {
        $parametro = Parametro::where('tipo_id', $tipo_id)->firstOrFail();
        $parametro->increment('numeracion');
        return $parametro->serie . '-' . $this->dar_formato($parametro->numeracion);
    }

    /* Para select2 Buscar Productos */
    public function ProductoCodigo($idproducto)
    {
        return DB::table('productos as p')
            ->join('tallas as t', 'p.idtalla', '=', 't.idtalla')
            ->where('p.estado', '=', '1')
            ->where('p.idproducto', '=', $idproducto)
            ->select(
                'p.idproducto',
                'p.descripcion',
                't.descripcion as talla',
                'p.precio',
                'p.stock'
            )->get();
    }

    public function PorTipo($tipo_id)
    {
        return DB::table('tipo as t')
            ->join('parametros as p', 'p.tipo_id', '=', 't.tipo_id')
            ->where('t.tipo_id', '=', $tipo_id)
            ->select('t.tipo_id', 't.descripcion', 'p.serie', 'p.numeracion')->get();
    }

    public function show($id)
    {
        $venta = CabeceraVenta::findOrFail($id);
        return view('ventas.show', compact('venta'));
    }
}
