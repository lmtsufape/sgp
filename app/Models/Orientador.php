<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orientador extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpf',
        'matricula'
    ];

    public function user()
    {
        return $this->morphOne(User::class, "typage");
    }

    public function edital_orientadors()
    {
        return $this->hasMany(Edital_orientador::class);
    }
}
