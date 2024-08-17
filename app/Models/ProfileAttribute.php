<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileAttribute extends Model
{
    use SoftDeletes;

    protected $table = 'profile_attributes';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'profile_id',
        'attribute',
        'data_di_creazione',
        'data_di_modifica',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'data_di_creazione' => 'datetime',
            'data_di_modifica' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }
}
