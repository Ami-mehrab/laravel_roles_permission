<?php
 
namespace Database\Seeders;
 
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
 
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Define permissions
        $permissions = [
            'view users', 'create users', 'edit users', 'delete users',
            'view roles', 'create roles', 'edit roles', 'delete roles',
            'view permissions', 'create permissions', 'edit permissions', 'delete permissions',
            'view articles', 'create articles', 'edit articles', 'delete articles',

            //  Job permissions
            'view jobs', 'create jobs', 'edit jobs', 'delete jobs',

            //
            'view applications',
        ];
 
        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
 
        // Create role
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
 
        // Assign all permissions to the role
        $superAdminRole->syncPermissions(Permission::all());
 
        // Create a super admin user
        $user = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('123456789'),
            ]
        );
        Role::firstOrCreate(['name' => 'Employer']);
        Role::firstOrCreate(['name' => 'Candidate']);
 
        // Assign role to user
        $user->assignRole($superAdminRole);
    }
}
 