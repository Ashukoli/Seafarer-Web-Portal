<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Define permissions (you can expand this list)
        $permissions = [
            'manage.users',
            'manage.roles',
            'view.candidates',
            'edit.candidates',
            'post.jobs',
            'manage.company.profile',
            'view.reports',
            'export.data',
            'access.dashboard',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // --- Roles ---
        $roles = [
            'super_admin',
            'admin_subadmin',
            'executive',
            'company_super_admin',
            'company_subadmin',
            'candidate',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        // --- Assign permissions to roles ---

        // Super admin gets everything
        Role::findByName('super_admin')->givePermissionTo(Permission::all());

        // Admin Subadmin
        Role::findByName('admin_subadmin')->givePermissionTo([
            'manage.users',
            'view.candidates',
            'edit.candidates',
            'access.dashboard',
        ]);

        // Executive
        Role::findByName('executive')->givePermissionTo([
            'view.candidates',
            'access.dashboard',
        ]);

        // Company Super Admin
        Role::findByName('company_super_admin')->givePermissionTo([
            'manage.company.profile',
            'post.jobs',
            'view.reports',
            'access.dashboard',
        ]);

        // Company Subadmin
        Role::findByName('company_subadmin')->givePermissionTo([
            'post.jobs',
            'manage.company.profile',
            'access.dashboard',
        ]);

        // Candidate
        Role::findByName('candidate')->givePermissionTo([
            'access.dashboard',
        ]);
    }
}
