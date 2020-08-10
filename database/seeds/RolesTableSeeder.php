<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    private $roles = ['Admin','guest'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $role) {
            $r = Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
            if($role == 'Admin'){
            	$r->givePermissionTo(['Administer roles & permissions', 'Access admin page']);
            }
        }
    }
}
