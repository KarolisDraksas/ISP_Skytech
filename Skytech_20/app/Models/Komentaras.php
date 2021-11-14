<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentaras extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_user',
        'fk_preke',
        'pavadinimas',
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
  /*  public function komUser()
    {
        return $this->hasOne(User::class, 'id', 'fk_user');
    }*/

    /**
     * @return HasOne
     */
    public function komPreke()
    {
        return $this->hasOne(Komentaras::class, 'id', 'fk_preke');
    }
}
