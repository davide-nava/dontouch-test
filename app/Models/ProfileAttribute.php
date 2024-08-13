<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileAttribute extends Model
{

    protected $table = 'profile_attributes';
    protected $primaryKey = 'id';
    public $incrementing = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'profile_id',
        'attribute',
        'data_di_creazione',
        'data_di_modifica',
        'deleted_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'deleted_at',
    ];

}
