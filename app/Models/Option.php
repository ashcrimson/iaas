<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Option
 * @package App\Models
 * @version November 4, 2019, 1:09 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection users
 * @property integer option_id
 * @property string nombre
 * @property string ruta
 * @property string descripcion
 * @property string icono_l
 * @property string icono_r
 * @property integer orden
 */
class Option extends Model
{

    use SoftDeletes;

    public $table = 'options';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $with = ['children'];

    protected $appends= ['active'];

    public $fillable = [
        'option_id',
        'nombre',
        'ruta',
        'descripcion',
        'icono_l',
        'icono_r',
        'orden'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'option_id' => 'integer',
        'nombre' => 'string',
        'ruta' => 'string',
        'descripcion' => 'string',
        'icono_l' => 'string',
        'icono_r' => 'string',
        'orden' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'ruta' => 'required',
        'icono_l' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'option_user');
    }

    public function children()
    {
        return $this->hasMany(Option::class,'option_id','id');
    }

    public function hasChildren()
    {
        return $this->children->count()>0;
    }

    public function hasTreeview()
    {
        return $this->hasChildren() ? 'has-treeview' : '';
    }

    public function active()
    {
        if (!$this->ruta){
            return '';
        }
        return request()->route()->getName() == $this->ruta ? 'active' : '';
    }

    public function openTreeView($children=null)
    {

        return $this->allDescendant()->contains('active','active') ? 'menu-open' : '';

    }

    public function allDescendant($children=null,$all=null)
    {
        $all = $all ?? collect();

        $children = $children ?? $this->children;

        foreach ($children as $child){
            $all = $all->push($child);
            if ($child->children->count()>0){
                $this->allDescendant($child->children,$all);
            }
        }

        return $all;
    }

    public function getActiveAttribute()
    {
        return $this->active();
    }

    public function scopePadres($query)
    {
        return $query->whereNull('option_id');
    }

    public function scopePadresDe($query,$chidres)
    {
        return $query->whereNull('option_id')->whereHas('children',function ($q)use ($chidres){
                $q->whereIn('id',$chidres);
        });
    }

}