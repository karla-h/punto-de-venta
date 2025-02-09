<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Parametro;
use App\Models\Tipo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GenerateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public static function datos() {
        $tipo = new Tipo();
        $tipo->descripcion = "Factura";
        $tipo->save();
        $tipo1 = new Tipo();
        $tipo1->descripcion = "Boleta";
        $tipo1->save();

        $para = new Parametro();
        $para->tipo_id = 1;
        $para->numeracion = '01000';
        $para->serie = '001';
        $para->save();

        $para1 = new Parametro();
        $para1->tipo_id = 2;
        $para1->numeracion = '01000';
        $para1->serie = '002';
        $para1->save();

        $cliente = new Cliente();
        $cliente->ruc_dni = '12545678';
        $cliente->nombres = 'Nuevo Cliente';
        $cliente->email = 'nuevo@gmail.com';
        $cliente->direccion = 'Larco';
        $cliente->save();
    }
}
