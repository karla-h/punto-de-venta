<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $primaryKey = 'cliente_id';
    public $timestamps = false;
    protected $fillable = ['cliente_id', 'ruc_dni', 'nombres', 'email', 'direccion'];
    
    public function ventas()
    {
        return $this->hasMany('App\CabeceraVenta', 'cliente_id', 'cliente_id');
    }
}
