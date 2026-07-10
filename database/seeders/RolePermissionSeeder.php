<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Services
            'view services',
            'create services',
            'edit services',
            'delete services',
            
            // Posts/Blog
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
            
            // Categories
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',
            
            // Contacts
            'view contacts',
            'edit contacts',
            'delete contacts',
            
            // Leads
            'view leads',
            'create leads',
            'edit leads',
            'delete leads',
            
            // Jobs
            'view jobs',
            'create jobs',
            'edit jobs',
            'delete jobs',
            
            // Job Applications
            'view applications',
            'edit applications',
            'delete applications',
            
            // Newsletter
            'view newsletter',
            'manage newsletter',
            
            // Settings
            'view settings',
            'edit settings',
            
            // Users & Roles
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage roles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo([
            'view services', 'create services', 'edit services', 'delete services',
            'view posts', 'create posts', 'edit posts', 'delete posts',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view contacts', 'edit contacts', 'delete contacts',
            'view leads', 'create leads', 'edit leads', 'delete leads',
            'view jobs', 'create jobs', 'edit jobs', 'delete jobs',
            'view applications', 'edit applications',
            'view newsletter', 'manage newsletter',
            'view settings', 'edit settings',
            'view users', 'create users', 'edit users',
        ]);

        $staff = Role::firstOrCreate(['name' => 'staff']);
        $staff->givePermissionTo([
            'view services',
            'view posts', 'create posts', 'edit posts',
            'view categories',
            'view contacts', 'edit contacts',
            'view leads', 'edit leads',
            'view jobs',
            'view applications', 'edit applications',
            'view newsletter',
            'view settings',
        ]);

        // Create super admin user
        $user = User::firstOrCreate(
            ['email' => 'admin@kangganui-rcm.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'phone' => '+1234567890',
                'is_active' => true,
            ]
        );
        
        $user->assignRole('super_admin');

        $this->command->info('Roles and permissions created successfully!');
        $this->command->info('Super Admin: admin@kangganui-rcm.com / password');
    }
}
