<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'see.users', 'guard_name' => 'web', 'group_name' => 'user', 'type' => 'system'],
            ['name' => 'edit.user', 'guard_name' => 'web', 'group_name' => 'user', 'type' => 'system'],
            ['name' => 'delete.user', 'guard_name' => 'web', 'group_name' => 'user', 'type' => 'system'],
            ['name' => 'add.user', 'guard_name' => 'web', 'group_name' => 'user', 'type' => 'system'],

            ['name' => 'see.roles', 'guard_name' => 'web', 'group_name' => 'role', 'type' => 'system'],
            ['name' => 'edit.role', 'guard_name' => 'web', 'group_name' => 'role', 'type' => 'system'],
            ['name' => 'edit.role.permissions', 'guard_name' => 'web', 'group_name' => 'role', 'type' => 'system'],
            ['name' => 'delete.role', 'guard_name' => 'web', 'group_name' => 'role', 'type' => 'system'],
            ['name' => 'add.role', 'guard_name' => 'web', 'group_name' => 'role', 'type' => 'system'],

            ['name' => 'see.monitors', 'guard_name' => 'web', 'group_name' => 'monitor', 'type' => 'system'],
            ['name' => 'see.monitor.details', 'guard_name' => 'web', 'group_name' => 'monitor', 'type' => 'system'],
            ['name' => 'edit.monitor', 'guard_name' => 'web', 'group_name' => 'monitor', 'type' => 'system'],
            ['name' => 'delete.monitor', 'guard_name' => 'web', 'group_name' => 'monitor', 'type' => 'system'],
            ['name' => 'add.monitor', 'guard_name' => 'web', 'group_name' => 'monitor', 'type' => 'system'],

            ['name' => 'see.activity', 'guard_name' => 'web', 'group_name' => 'activity', 'type' => 'system'],

            ['name' => 'see.statuspage', 'guard_name' => 'web', 'group_name' => 'status_page', 'type' => 'system'],
            ['name' => 'see.incidents', 'guard_name' => 'web', 'group_name' => 'incident', 'type' => 'system'],

            ['name' => 'manage.coupons', 'guard_name' => 'web', 'group_name' => 'coupons', 'type' => 'system'],

            ['name' => 'delete.subuser', 'guard_name' => 'web', 'group_name' => 'subuser', 'type' => 'system'],
            ['name' => 'add.subuser', 'guard_name' => 'web', 'group_name' => 'subuser', 'type' => 'system'],
            ['name' => 'edit.subuser', 'guard_name' => 'web', 'group_name' => 'subuser', 'type' => 'system'],
            
        ];

        $permissionNames = array_column($permissions, 'name');

        // Delete permissions not in the list
        Permission::whereNotIn('name', $permissionNames)->delete();

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name'], 'guard_name' => $permission['guard_name']],
                ['group_name' => $permission['group_name'], 'type' => $permission['type']]
            );
        }
    }
}