<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        $team_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0, 5) != 'team_';
        });
        Role::findOrFail(2)->permissions()->sync($team_permissions);
        Role::findOrFail(3)->permissions()->sync($team_permissions);

        $user_permissions = $team_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_';
        });
        Role::findOrFail(4)->permissions()->sync($user_permissions);
    }
}
