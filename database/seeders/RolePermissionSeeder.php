<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        | Reset Cached Roles & Permissions
        */

        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        /*
        | Permissions
        */

        $permissions = [

            // Auth
            'login',
            'logout',

            // Applicant
            'submit_application',
            'view_own_application',

            // Staff RPL
            'review_application',
            'assign_assessor',
            'generate_sk',

            // Assessor
            'assess_application',

            // Committee
            'approve_application',

            // System Admin
            'manage_users',
            'manage_roles',
            'manage_permissions',
            'manage_courses',
            'manage_study_programs',
        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        /*
        | Roles
        */

        $applicant = Role::firstOrCreate([
            'name' => 'applicant'
        ]);

        $staffRpl = Role::firstOrCreate([
            'name' => 'staff_rpl'
        ]);

        $assessor = Role::firstOrCreate([
            'name' => 'assessor'
        ]);

        $committee = Role::firstOrCreate([
            'name' => 'committee'
        ]);

        $systemAdmin = Role::firstOrCreate([
            'name' => 'system_admin'
        ]);

        /*
        | Assign Permissions To Roles
        */

        $applicant->givePermissionTo([
            'login',
            'logout',
            'submit_application',
            'view_own_application',
        ]);

        $staffRpl->givePermissionTo([
            'login',
            'logout',
            'review_application',
            'assign_assessor',
            'generate_sk',
        ]);

        $assessor->givePermissionTo([
            'login',
            'logout',
            'assess_application',
        ]);

        $committee->givePermissionTo([
            'login',
            'logout',
            'approve_application',
        ]);

        $systemAdmin->givePermissionTo(Permission::all());
    }
}