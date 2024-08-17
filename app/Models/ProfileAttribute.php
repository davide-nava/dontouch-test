<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileAttribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profile_attributes';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'id',
        'profile_id',
        'attribute',
        'data_di_creazione',
        'data_di_modifica',
    ];

    protected $hidden = [
        'deleted_at',
        'update_at',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'data_di_creazione' => 'datetime',
            'data_di_modifica' => 'datetime',
            'deleted_at' => 'datetime',
            'update_at' => 'datetime',
            'created_at' => 'datetime',
        ];
    }
}
