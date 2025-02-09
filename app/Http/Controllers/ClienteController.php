<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PAGINATION=10;

    public function index(Request $request)
{
    $buscarpor = $request->get('buscarpor');
    // Obtener todos los clientes que coincidan con el nombre o RUC/DNI
    $clientes = Cliente::where('nombres', 'like', "%$buscarpor%")
                        ->orWhere('ruc_dni', 'like', "%$buscarpor%")
                        ->paginate(10); // Paginar los resultados en bloques de 10

    return view('clientes.index', compact('clientes', 'buscarpor'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'ruc_dni' => 'required|max:20',
                'nombres' => 'required|max:100',
                'email' => 'required|email|max:100',
                'direccion' => 'required|max:255'
            ],
            [
                'ruc_dni.required' => 'Ingrese RUC/DNI del cliente',
                'ruc_dni.max' => 'Máximo 20 caracteres para RUC/DNI',
                'nombres.required' => 'Ingrese el nombre del cliente',
                'nombres.max' => 'Máximo 100 caracteres para el nombre',
                'email.required' => 'Ingrese el correo electrónico del cliente',
                'email.email' => 'El correo electrónico no es válido',
                'email.max' => 'Máximo 100 caracteres para el correo',
                'direccion.required' => 'Ingrese la dirección del cliente',
                'direccion.max' => 'Máximo 255 caracteres para la dirección'
            ]
        );

        $cliente = new Cliente();
        $cliente->ruc_dni = $request->ruc_dni;
        $cliente->nombres = $request->nombres;
        $cliente->email = $request->email;
        $cliente->direccion = $request->direccion;
        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado correctamente');
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
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = request()->validate(
            [
                'ruc_dni' => 'required|max:20',
                'nombres' => 'required|max:100',
                'email' => 'required|email|max:100',
                'direccion' => 'required|max:255'
            ],
            [
                'ruc_dni.required' => 'Ingrese RUC/DNI del cliente',
                'ruc_dni.max' => 'Máximo 20 caracteres para RUC/DNI',
                'nombres.required' => 'Ingrese el nombre del cliente',
                'nombres.max' => 'Máximo 100 caracteres para el nombre',
                'email.required' => 'Ingrese el correo electrónico del cliente',
                'email.email' => 'El correo electrónico no es válido',
                'email.max' => 'Máximo 100 caracteres para el correo',
                'direccion.required' => 'Ingrese la dirección del cliente',
                'direccion.max' => 'Máximo 255 caracteres para la dirección'
            ]
        );

        $cliente = Cliente::findOrFail($id);
        $cliente->ruc_dni = $request->ruc_dni;
        $cliente->nombres = $request->nombres;
        $cliente->email = $request->email;
        $cliente->direccion = $request->direccion;
        $cliente->save();

        return redirect()->route('clientes.index')->with('datos', 'Cliente Actualizado...!');
    }

    public function confirmar($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.confirmar', compact('cliente'));
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('datos', 'Cliente Eliminado...!');
    }
}
