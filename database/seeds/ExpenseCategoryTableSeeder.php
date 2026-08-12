<?php

use App\ExpenseCategory;
use Illuminate\Database\Seeder;

class ExpenseCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExpenseCategory::create([
            'name' => 'Publicidad',
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);

        ExpenseCategory::create([
            'name' => 'Cobertura medica',
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);
        ExpenseCategory::create([
            'name' => 'Sistema de seguridad',
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);

        ExpenseCategory::create([
            'name' => 'Cuotas y suscripciones',
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);

        ExpenseCategory::create([
            'name' => 'Alquiler del local',
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);

        ExpenseCategory::create([
            'name' => 'Mantenimiento y reparaciones(incluye Maq. Fitnes)',
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);

        ExpenseCategory::create([
            'name' => 'Gastos de oficina',
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);

        ExpenseCategory::create([
            'name' => 'Suministros alimenticios',
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);

        ExpenseCategory::create([
            'name' => 'Suministros de limpiesa',
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);

        ExpenseCategory::create([
            'name' => 'Gastos médicos',
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);

        ExpenseCategory::create([
            'name' => 'Sorteos',
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);
        
        ExpenseCategory::create([
            'name' => 'Eventos',
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);

        ExpenseCategory::create([
            'name' => 'Otros gastos',
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }
}
