<?php

namespace Database\Seeders;

use App\Models\Aluno;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AlunosSeeder extends Seeder
{

    public function run()
    {
        $aluno = Aluno::create([
            'cpf' => "348.126.240-02",
            'id_curso' => 1,
            'semestre_entrada' => "2018.2"
        ]);

        $aluno->user()->create([
            'name' => "Victor Francisco",
            'email' => "victorfran18@gmail.com",
            'password' =>  Hash::make('12345678')
        ])->givePermissionTo('aluno');
    }
}
