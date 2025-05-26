<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roleUser = Role::create(['name' => 'user']);
        $roleAdmin = Role::create(['name' => 'admin']);

        $user1 = User::where('email', 'john.doe@labforty.com')->first();
        $user2 = User::where('email', 'bob.bobber@labforty.com')->first();

        $user1?->assignRole($roleUser);
        $user2?->assignRole($roleAdmin);
    }
}
