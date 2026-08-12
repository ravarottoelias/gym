<?php

use App\Member;
use Illuminate\Database\Seeder;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fakerEs = Faker\Factory::create('es_ES');
        $faker = Faker\Factory::create('es_US');
        
        foreach (range(0, 175) as $number) {

            $fullname = $faker->lastName() . ' ' . $faker->firstName();
            $email = str_replace(' ', '.', $fullname) . '@' . $faker->freeEmailDomain();
            
            Member::create([
                'member_code' => $fakerEs->dni(),
                'name' => $fullname,
                'DOB' => $faker->date($format = 'Y-m-d', $max = '2000-01-11'),
                'email' => strtolower($email),
                'address' => $fakerEs->address(),
                'status' => 1,
                'gender' => 'm',
                'contact' => $faker->e164PhoneNumber(),
                'created_by' => 1,
                'updated_by' => 1, 
            ]);
        }

    }
}
