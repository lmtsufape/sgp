<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsSeeder::class,
            OrientadorsSeeder::class,
            ServidorSeeder::class,
            VinculosSeeder::class,
            AlunosSeeder::class,
            ProgramasSeeder::class,
            CursoSeeder::class,
            DisciplinaSeeder::class
        ]);
    }
}