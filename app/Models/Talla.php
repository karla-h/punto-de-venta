<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    use HasFactory;
    protected $table = 'tallas';
    protected $primaryKey = 'idtalla';
    public $timestamps = false;
    protected $fillable = ['descripcion', 'estado'];

    public function productos()
    {
        return $this->hasMany('App\Models\Producto', 'idtalla', 'idtalla');
    }
}
