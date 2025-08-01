<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        try {
            $admin = User::updateOrCreate(
                ['id' => '1',],
                [
                    'name' => 'Developer',
                    'email' => 'admin@gmail.com',
                    'phone' => '01710000000',
                    'password' => Hash::make('12345678'),
                    'password_hint' => base64_encode('12345678')
                ]
            );
            $adminRole = Role::updateOrCreate(['name' => 'Administrative']);
            $userRoles = ['Administrative'];
            foreach ($userRoles as $role) {
                if (!empty($role)) {
                    Role::updateOrCreate(
                        [
                            'name' => $role
                        ],
                    );
                }
            }
            $permissions = [
                'user_list',
                'user_create',
                'user_edit',
                'user_delete',
                'permission_list',
                'permission_edit',
                'permission_create',
                'permission_delete',
                'role_list',
                'role_create',
                'role_edit',
                'role_delete',
                'upload_file_list'
            ];

            foreach ($permissions as $permission) {
                if (!empty($permission)) {
                    Permission::updateOrCreate(
                        [
                            'name' => $permission
                        ],
                        [
                            'guard_name' => 'web',
                        ]
                    );
                }
            }
            $adminRole->givePermissionTo($permissions);
            $admin->assignRole('Administrative');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
