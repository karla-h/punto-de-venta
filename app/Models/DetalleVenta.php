<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalleventas';
    public $timestamps = false;

    protected $fillable = ['precio', 'cantidad', 'venta_id', 'producto_id'];

    // Relación con la cabecera de venta (Venta)
    public function venta()
    {
        return $this->belongsTo(CabeceraVenta::class, 'venta_id', 'venta_id');
    }

    // Relación con el producto
    public function producto()
    {
        return $this->belongsTo('App\Models\Producto', 'producto_id', 'idproducto');
    }
}
