<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $primaryKey = 'id';

    public $incrementing = true;
    public $autoincrement = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'nome',
        'cognome',
        'numero_di_telefono',
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

    public function attributes(): HasMany
    {
        return $this->hasMany(ProfileAttribute::class, 'profile_id', 'id');
    }
}
