<?php

use App\Plan;
use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'plan_code' => 'P01',
            'service_id' => 1,
            'plan_name'  => 'Plan Base',
            'plan_details'  => 'Maquina + plan de ejercicio',
            'created_by' => 1,
            'updated_by' => 1,
            'days' => 30,
            'amount' => 2000,
            'status'=> 1,
        ]);

        Plan::create([
            'plan_code' => 'P02',
            'service_id' => 1,
            'plan_name'  => 'Plan Novato',
            'plan_details'  => 'Maquina + Prof. Seguimiento',
            'created_by' => 1,
            'updated_by' => 1,
            'days' => 30,
            'amount' => 2500,
            'status'=> 1,
        ]);

        Plan::create([
            'plan_code' => 'P03',
            'service_id' => 1,
            'plan_name'  => 'Plan Juniors',
            'plan_details'  => 'Maquina + Personal trainer',
            'created_by' => 1,
            'updated_by' => 1,
            'days' => 30,
            'amount' => 4500,
            'status'=> 1,

            
        ]);

        Plan::create([
            'plan_code' => 'P04',
            'service_id' => 1,
            'plan_name'  => 'Plan PRO',
            'plan_details'  => 'Maquina + Personal trainer + Plan Nutricional',
            'created_by' => 1,
            'updated_by' => 1,
            'days' => 30,
            'amount' => 5500,
            'status'   => 1,
        ]);

        Plan::create([
            'plan_code' => 'P05',
            'service_id' => 2,
            'plan_name'  => 'Crossfit 3/7',
            'plan_details'  => 'Tres dias a la semana.',
            'created_by' => 1,
            'updated_by' => 1,
            'days' => 30,
            'amount' => 4500,  
            'status' => 1,
        ]);

        Plan::create([
            'plan_code' => 'P06',
            'service_id' => 2,
            'plan_name'  => 'Crossfit 5/7',
            'plan_details'  => 'Cinco dias a la semana.',
            'created_by' => 1,
            'updated_by' => 1,
            'days' => 30,
            'amount' => 5500,
            'status'   => 1,
        ]);

        Plan::create([
            'plan_code' => 'P07',
            'service_id' => 3,
            'plan_name'  => 'Entrenamiento Funcional 5/7',
            'plan_details'  => 'Cinco dias a la semana.',
            'created_by' => 1,
            'updated_by' => 1,
            'days' => 30,
            'amount' => 3500,
            'status'   => 1,
        ]);

        

    }
}
