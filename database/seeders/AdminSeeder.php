<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        | Create System Admin
        */

        $admin = User::firstOrCreate(
            [
                'email' => 'gilbert@grpl.com'
            ],
            [
                'name' => 'System Admin',

                'password' => Hash::make('Seadragon555'),

                'status' => 'active',

                'email_verified_at' => now(),
            ]
        );

        /*
        | Assign Role
        */

        $admin->assignRole('system_admin');
    }
}