<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $primaryKey = 'idproducto';

    public $timestamps = false;

    public function categorias()
    {
        return $this->belongsTo('App\Models\Categoria', 'idcategoria', 'idcategoria');
    }

    public function tallas()
    {
        return $this->belongsTo('App\Models\Talla', 'idtalla', 'idtalla');
    }
}
