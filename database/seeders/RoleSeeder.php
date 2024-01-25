<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $role_admin=Role::create(['name'=>'admin']);
    $role_student=Role::create(['name'=>'student']);

    $permission_create_role=Permission::create(['name'=>'create roles']);
    $permission_read_role=Permission::create(['name'=>'read roles']);
    $permission_update_role=Permission::create(['name'=>'update roles']);
    $permission_delete_role=Permission::create(['name'=>'delete roles']);

    $permission_create_category=Permission::create(['name'=>'create categories']);
    $permission_read_category=Permission::create(['name'=>'read categories']);
    $permission_update_category=Permission::create(['name'=>'update categories']);
    $permission_delete_category=Permission::create(['name'=>'delete categories']);

    $permission_create_location=Permission::create(['name'=>'create locations']);
    $permission_read_location=Permission::create(['name'=>'read locations']);
    $permission_update_location=Permission::create(['name'=>'update locations']);
    $permission_delete_location=Permission::create(['name'=>'delete locations']);

    $permissions_admin=[
        $permission_create_role,$permission_read_role,$permission_update_role,$permission_delete_role,$permission_create_category,$permission_read_category,$permission_update_category,$permission_delete_category,$permission_create_location,$permission_read_location,$permission_update_location,$permission_delete_location
    ];

    $permissions_student=[$permission_create_category,$permission_read_category,$permission_update_category,$permission_delete_category];

    $role_admin->syncPermissions($permissions_admin);
    $role_student->syncPermissions($permissions_student);
    

    }
}
