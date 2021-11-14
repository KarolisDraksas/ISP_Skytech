<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uzsakymas extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kaina',
        'prekiu_kiekis',
        'data',
        'pristatymo_budas',
        'statusas',
        'sudeliojimas',
        'adresas',

        'fk_vartotojas',
        'fk_darbuotojas',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'numeris';

    /**
     * @return HasOne
     */
    public function uzsakymasUser()
    {
        return $this->hasOne(User::class, 'id', 'fk_vartotojas');
    }

    /**
     * @return HasOne
     */
    public function uzsakymasWorker()
    {
        return $this->hasOne(User::class, 'id', 'fk_darbuotojas');
    }

    public function prekes()
    {
        return $this->belongsToMany(Preke::class, 'prekes_uzsakymas', 'fk_preke', 'fk_uzsakymas');
    }
}
