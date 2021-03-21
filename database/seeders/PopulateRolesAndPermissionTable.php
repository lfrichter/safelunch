<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PopulateRolesAndPermissionTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::firstOrCreate(['name' => 'admin']);

        $permission = Permission::firstOrCreate(['name' => 'delete authority']);
        $role->givePermissionTo($permission);

        $permission = Permission::firstOrCreate(['name' => 'delete establishment']);
        $role->givePermissionTo($permission);

        $role = Role::firstOrCreate(['name' => 'developer']);
    }
}
