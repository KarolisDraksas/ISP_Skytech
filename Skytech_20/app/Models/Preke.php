<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preke extends Model
{
    use HasFactory;

    protected $fillable = [
        'kodas',
        'pavadinimas',
        'gamintojas',
        'aprašymas',
        'kaina',
        'kiekis',
        'kategorija',
        'fk_id',
    ];

    protected $primaryKey = 'id';
    
    public function uzsakymas()
    {
        return $this->belongsToMany(Uzsakymas::class, 'prekes_uzsakymas', 'fk_uzsakymas', 'fk_preke');
    }
}
