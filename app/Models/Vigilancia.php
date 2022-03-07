<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Vigilancia
 * @package App\Models
 * @version September 22, 2021, 4:17 pm CST
 *
 * @property \App\Models\SolicitudEstado $estado
 * @property \App\Models\Paciente $paciente
 * @property \App\Models\User $userCrea
 * @property \App\Models\User $userActualiza
 * @property \Illuminate\Database\Eloquent\Collection $cultivos
 * @property \Illuminate\Database\Eloquent\Collection $diagnosticos
 * @property \Illuminate\Database\Eloquent\Collection $medicamentos
 * @property \Illuminate\Database\Eloquent\Collection $microorganismos
 * @property integer $paciente_id
 * @property integer $estado_id
 * @property boolean $pesquisa
 * @property string $dip
 * @property string $procedimientos_cirugia
 * @property string $iarepi
 * @property string $paa
 * @property string $comentarios
 */
class Vigilancia extends Model
{
    use SoftDeletes;

    public $table = 'vigilancias';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'paciente_id',
        'pesquisa',
        'dip',
        'procedimientos_cirugias',
        'iarepi',
        'paa',
        'comentarios',
        'descserv',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'paciente_id' => 'integer',
        'pesquisa' => 'boolean',
        'dip' => 'string',
        'procedimientos_cirugias' => 'string',
        'iarepi' => 'string',
        'paa' => 'string',
        'comentarios' => 'string',
        'descserv' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'run' => 'required|string|max:255',
        'dv_run' => 'required|string|max:255',
        'apellido_paterno' => 'required|string|max:255',
        'apellido_materno' => 'nullable|string|max:255',
        'primer_nombre' => 'required|string|max:255',
        'segundo_nombre' => 'nullable|string|max:255',

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function estado()
    {
        return $this->belongsTo(\App\Models\SolicitudEstado::class, 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function paciente()
    {
        return $this->belongsTo(\App\Models\Paciente::class, 'paciente_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userCrea()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_crea');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userActualiza()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_actualiza');
    }

   

}
