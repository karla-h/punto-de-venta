<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabeceraVenta extends Model
{
    use HasFactory;

    protected $table = 'cabeceraventas';
    protected $primaryKey = 'venta_id';
    public $timestamps = false;
    protected $fillable = [
        'cliente_id', 'tipo_id', 'fecha_venta', 'nro_doc', 'total', 'igv', 'subtotal', 'estado'
    ];
    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'cliente_id', 'cliente_id');
    }
    public function detalleventas()
    {
        return $this->hasMany('App\Models\DetalleVenta', 'venta_id', 'venta_id');
    }
    public function tipo()
    {
        return $this->hasOne(Tipo::class, 'tipo_id', 'tipo_id');
    }
}
