<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(SettingsTableSeeder::class);
        $this->call(SmsTriggersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionsRoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(ExpenseCategoryTableSeeder::class);
        $this->call(PlanTableSeeder::class);
        $this->call(ShiftTableSeeder::class);
        $this->call(MemberTableSeeder::class);

        Model::reguard();
    }
}
