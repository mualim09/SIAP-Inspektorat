<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::firstOrCreate([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@local.host',
            'phone' => '82266421945',
            'password' => 'secret',
        ]);
        $user->assignRole('Admin');
    }
}
