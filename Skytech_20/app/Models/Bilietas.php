<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Bilietas extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'aktyvumas',
        'sukurimas',
        'uzdarymas',
        'pavadinimas',
        'darbuotojo_komentaras',
        'kategorija',

        'fk_vartotojas',
        'fk_darbuotojas',

        'vertinimo_data',
        'vartotojo_komentaras',
        'pagalbos_ivertis',
        'benravimo_ivertis',
        'greicio_ivertis',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @return HasOne
     */
    public function bilietasUser()
    {
        return $this->hasOne(User::class, 'id', 'fk_vartotojas');
    }

    /**
     * @return HasOne
     */
    public function bilietasWorker()
    {
        return $this->hasOne(User::class, 'id', 'fk_darbuotojas');
    }

    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

}
