<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\Assessor;
use App\Models\Committee;
use App\Models\StaffRpl;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserManagementService
{
    /**
     * Get all management users.
     */
    public function list(array $filters = []): LengthAwarePaginator
    {
        return User::query()

            ->with([
                'roles',
                'assessor',
                'staffRpl',
                'committee',
            ])

            ->whereHas('roles', function ($query) {
                $query->whereIn('name', [
                    UserRole::ASSESSOR,
                    UserRole::STAFF_RPL,
                    UserRole::COMMITTEE,
                ]);
            })

            ->when(
                $filters['search'] ?? null,
                function (Builder $query, string $search) {

                    $query->where(function ($query) use ($search) {

                        $query->where(
                            'name',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhere(
                            'email',
                            'like',
                            "%{$search}%"
                        );
                    });
                }
            )

            ->when(
                $filters['role'] ?? null,
                function (Builder $query, string $role) {

                    $query->whereHas(
                        'roles',
                        function ($query) use ($role) {

                            $query->where('name', $role);
                        }
                    );
                }
            )

            ->when(
                isset($filters['is_active']),
                function (Builder $query) use ($filters) {

                    $query->where(
                        'is_active',
                        $filters['is_active']
                    );
                }
            )

            ->latest()

            ->paginate(
                $filters['per_page'] ?? 10
            );
    }

    /**
     * Get user detail.
     */
    public function getById(int $id): User
    {
        return User::with([
            'roles',
            'assessor',
            'staffRpl',
            'committee',
        ])->findOrFail($id);
    }

    /**
     * Create management user.
     */
    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {

            /*
            |--------------------------------------------------------------------------
            | Create User
            |--------------------------------------------------------------------------
            */

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make(
                    $data['password']
                ),
                'email_verified_at' => now(),
                'is_active' => true,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Assign Role
            |--------------------------------------------------------------------------
            */

            $user->assignRole(
                $data['role']
            );

            /*
            |--------------------------------------------------------------------------
            | Create Master Table
            |--------------------------------------------------------------------------
            */

            match ($data['role']) {

                UserRole::ASSESSOR => Assessor::create([
                    'user_id' => $user->id,
                    'nip' => $data['nip'],
                    'phone' => $data['phone'] ?? null,
                    'address' => $data['address'] ?? null,
                ]),

                UserRole::STAFF_RPL => StaffRpl::create([
                    'user_id' => $user->id,
                    'nip' => $data['nip'],
                    'phone' => $data['phone'] ?? null,
                ]),

                UserRole::COMMITTEE => Committee::create([
                    'user_id' => $user->id,
                    'nip' => $data['nip'],
                    'phone' => $data['phone'] ?? null,
                ]),
            };

            return $this->getById(
                $user->id
            );
        });
    }

    /**
     * Update management user.
     */
    public function update(
        int $id,
        array $data
    ): User {

        return DB::transaction(function () use ($id, $data) {

            $user = User::with([
                'roles',
                'assessor',
                'staffRpl',
                'committee',
            ])->findOrFail($id);

            /*
            |--------------------------------------------------------------------------
            | Prevent System Admin Modification
            |--------------------------------------------------------------------------
            */

            if (
                $user->hasRole(
                    UserRole::SYSTEM_ADMIN
                )
            ) {
                abort(
                    403,
                    'System admin cannot be modified.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Update User
            |--------------------------------------------------------------------------
            */

            $payload = [
                'name' => $data['name'],
                'email' => $data['email'],
            ];

            /*
            |--------------------------------------------------------------------------
            | Optional Password Update
            |--------------------------------------------------------------------------
            */

            if (!empty($data['password'])) {

                $payload['password'] = Hash::make(
                    $data['password']
                );
            }

            $user->update($payload);

            /*
            |--------------------------------------------------------------------------
            | Update Assessor
            |--------------------------------------------------------------------------
            */

            if (
                $user->hasRole(
                    UserRole::ASSESSOR
                )
            ) {

                $user->assessor()->update([
                    'nip' => $data['nip'],
                    'phone' => $data['phone'] ?? null,
                    'address' => $data['address'] ?? null,
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Update Staff RPL
            |--------------------------------------------------------------------------
            */

            if (
                $user->hasRole(
                    UserRole::STAFF_RPL
                )
            ) {

                $user->staffRpl()->update([
                    'nip' => $data['nip'],
                    'phone' => $data['phone'] ?? null,
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Update Committee
            |--------------------------------------------------------------------------
            */

            if (
                $user->hasRole(
                    UserRole::COMMITTEE
                )
            ) {

                $user->committee()->update([
                    'nip' => $data['nip'],
                    'phone' => $data['phone'] ?? null,
                ]);
            }

            return $this->getById(
                $user->id
            );
        });
    }

    /**
     * Toggle user active status.
     */
    public function toggleStatus(
        int $id,
        bool $isActive
    ): User {

        return DB::transaction(function () use ($id, $isActive) {

            $user = User::findOrFail($id);

            /*
            |--------------------------------------------------------------------------
            | Prevent Self Deactivation
            |--------------------------------------------------------------------------
            */

            if (
                auth()->id() === $user->id
            ) {
                abort(
                    403,
                    'You cannot deactivate your own account.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Prevent System Admin Modification
            |--------------------------------------------------------------------------
            */

            if (
                $user->hasRole(
                    UserRole::SYSTEM_ADMIN
                )
            ) {
                abort(
                    403,
                    'System admin cannot be modified.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Update Status
            |--------------------------------------------------------------------------
            */

            $user->update([
                'is_active' => $isActive,
                'status' => $isActive
                    ? 'active'
                    : 'inactive',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Refresh Model
            |--------------------------------------------------------------------------
            */

            $user->refresh();

            return $user;
        });
    }
}