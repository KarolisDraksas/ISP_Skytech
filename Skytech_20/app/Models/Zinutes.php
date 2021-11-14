<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Bilietas;

class Zinutes extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_rasytojas',
        'fk_bilietas',

        'tekstas',
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
    public function zinutesUser()
    {
        return $this->hasOne(User::class, 'id', 'fk_rasytojas');
    }

    /**
     * @return HasOne
     */
    public function zinutesBilietas()
    {
        return $this->hasOne(Bilietas::class, 'id', 'fk_bilietas');
    }
}
