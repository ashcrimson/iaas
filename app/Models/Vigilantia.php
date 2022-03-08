<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Vigilantia
 * @package App\Models
 * @version March 8, 2022, 12:53 pm -03
 *
 * @property boolean $pesquisa
 * @property string $dip
 * @property string $procedimientos_cirugias
 * @property string $paa
 * @property string $comentarios
 */
class Vigilantia extends Model
{
    use SoftDeletes;

    public $table = 'vigilantias';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'pesquisa',
        'dip',
        'procedimientos_cirugias',
        'paa',
        'comentarios'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'pesquisa' => 'boolean',
        'dip' => 'string',
        'procedimientos_cirugias' => 'string',
        'paa' => 'string',
        'comentarios' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'pesquisa' => 'nullable',
    ];

    
}
