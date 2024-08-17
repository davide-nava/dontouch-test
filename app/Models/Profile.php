<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profiles';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'id',
        'nome',
        'cognome',
        'numero_di_telefono',
        'data_di_creazione',
        'data_di_modifica',
    ];

    protected $hidden = [
        'deleted_at',
        'update_at',
        'created_at',
    ];

    public function attributes(): HasMany
    {
        return $this->hasMany(ProfileAttribute::class, 'profile_id', 'id');
    }

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
