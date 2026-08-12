<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'Maquinas',
            'description' => 'Ejercicios con máquinas.',
            'created_by' => 1,
            'updated_by' => 1
        ]);

        Service::create([
            'name' => 'Crossfit',
            'description' => 'Entrenamiento que conecta movimientos de diferentes disciplinas, tales como la halterofilia, el entrenamiento metabólico o el gimnástico.',
            'created_by' => 1,
            'updated_by' => 1
        ]);

        Service::create([
            'name' => 'Funcional',
            'description' => 'Ejercicios que se adaptan a los movimientos naturales del cuerpo humano para trabajar de forma global músculos y articulaciones',
            'created_by' => 1,
            'updated_by' => 1
        ]);

        Service::create([
            'name' => 'Spinning',
            'description' => 'Ejercicio aeróbico y cardiovascular que se realiza sobre una bicicleta estática en el que se trabaja el tren inferior: las piernas y los glúteos.',
            'created_by' => 1,
            'updated_by' => 1
        ]);

        Service::create([
            'name' => 'GAP',
            'description' => 'Actividad dirigida de tonificación para trabajar glúteos, abdomen y piernas.',
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }
}
