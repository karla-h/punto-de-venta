<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Parametro extends Model
{
    use HasFactory;
    protected $table = 'parametros';
    protected $primaryKey = 'tipo_id';
    public $timestamps = false;
    protected $fillable = [
        'numeracion', 'serie',
    ];

    public static function ActualizarNumero($tipo_id, $numeracion)
    {
        try {
            DB::table('parametros')
                ->where('tipo_id', '=', $tipo_id)
                ->update([
                    'numeracion' => $numeracion
                ]);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}
