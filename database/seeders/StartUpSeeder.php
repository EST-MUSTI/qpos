<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class StartUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            UnitSeeder::class,
            CurrencySeeder::class,
        ]);

        $user = User::updateOrCreate(
            ['email' => 'demo@qtecsolution.net'],
            [
                'name' => 'Mr Admin',
                'password' => bcrypt('87654321'),
                'username' => 'demo-admin',
                'is_suspended' => false,
            ]
        );

        $user->syncRoles(Role::findByName('Admin'));

        Customer::firstOrCreate(
            ['phone' => '012345678'],
            ['name' => 'Walking Customer']
        );

        Supplier::firstOrCreate(
            ['phone' => '012345678'],
            ['name' => 'Own Supplier']
        );
    }
}
