<?php

use App\Shift;
use Illuminate\Database\Seeder;

class ShiftTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shift::create([
            'name' => '8am a 9am',
            'slug' => '8am-a-9am',
            'start_at' => '08:00:00',
            'end_at' => '09:00:00',
        ]);

        Shift::create([
            'name' => '9am a 10am',
            'slug' => '9am-a-10am',
            'start_at' => '09:00:00',
            'end_at' => '10:00:00',
        ]);
    }
}
