<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DummyUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Dummy Applicant',
                'email' => 'dummy.applicant@grpl.test',
                'role' => 'applicant',
            ],
            [
                'name' => 'Dummy Staff',
                'email' => 'dummy.staff@grpl.test',
                'role' => 'staff_rpl',
            ],
            [
                'name' => 'Dummy Assessor',
                'email' => 'dummy.assessor@grpl.test',
                'role' => 'assessor',
            ],
            [
                'name' => 'Dummy Committee',
                'email' => 'dummy.committee@grpl.test',
                'role' => 'committee',
            ],
        ];

        foreach ($users as $dummyUser) {
            Role::findOrCreate($dummyUser['role']);

            $user = User::updateOrCreate(
                ['email' => $dummyUser['email']],
                [
                    'name' => $dummyUser['name'],
                    'password' => Hash::make('Seadragon555'),
                    'status' => 'active',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]
            );

            $user->syncRoles([$dummyUser['role']]);
        }
    }
}
