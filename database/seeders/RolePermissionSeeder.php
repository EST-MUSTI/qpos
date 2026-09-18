<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds_
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $roles = [
            'Admin',
            'cashier',
            'sales_associate',
            'demo_cashier',
        ];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $permissions = [
            //dashboard
            'dashboard_view',
            //customer
            'customer_create',
            'customer_view',
            'customer_update',
            'customer_delete',
            'customer_sales',
            //supplier

            'supplier_view',
            'supplier_create',
            'supplier_update',
            'supplier_delete',
            //product
            'product_create',
            'product_view',
            'product_update',
            'product_delete',
            'product_import',
            'product_purchase',
            //brand
            'brand_create',
            'brand_view',
            'brand_update',
            'brand_delete',
            //category
            'category_create',
            'category_view',
            'category_update',
            'category_delete',
            //unit
            'unit_create',
            'unit_view',
            'unit_update',
            'unit_delete',
            //sale
            'sale_create',
            'sale_view',
            'sale_update',
            'sale_delete',
            'sale_edit',
            //purchase
            'purchase_create',
            'purchase_view',
            'purchase_update',
            'purchase_delete',
            //reports
            'reports_summary',
            'reports_sales',
            'reports_inventory',
            //currency
            'currency_create',
            'currency_view',
            'currency_update',
            'currency_delete',
            'currency_set_default',
            //role
            'role_create',
            'role_view',
            'role_update',
            'role_delete',
            'permission_view',
            //user
            'user_create',
            'user_view',
            'user_update',
            'user_delete',
            'user_suspend',

            //setting
            'website_settings',
            'contact_settings',
            'socials_settings',
            'style_settings',
            'custom_settings',
            'notification_settings',
            'website_status_settings',
            'invoice_settings',

        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::findByName('Admin');
        $cashierRole = Role::findByName('cashier');
        $salesRole = Role::findByName('sales_associate');
        $demoRole = Role::findByName('demo_cashier');

        $admin->syncPermissions($permissions);

        $cashierPermissions = [
            'sale_create',
            'sale_view',
            'customer_view',
            'product_create',
            'product_view',
            'product_update',
            'product_delete',
            'product_import',
            'product_purchase',
        ];

        $salesPermissions = [
            //sale
            'sale_create',
            'sale_view',
            'sale_edit',
        ];

        $demoPermissions = [
            'sale_create',
        ];

        $cashierRole->syncPermissions($cashierPermissions);
        $salesRole->syncPermissions($salesPermissions);
        $demoRole->syncPermissions($demoPermissions);

        $cashierUser = User::updateOrCreate(
            ['email' => 'cashier@gmail.com'],
            [
                'name' => 'Mr Cashier',
                'password' => Hash::make('12345678'),
                'username' => 'demo-cashier',
                'is_suspended' => false,
            ]
        );
        $cashierUser->syncRoles($cashierRole);

        $salesUser = User::updateOrCreate(
            ['email' => 'sales@gmail.com'],
            [
                'name' => 'Mr Sales',
                'password' => Hash::make('12345678'),
                'username' => 'demo-sales',
                'is_suspended' => false,
            ]
        );
        $salesUser->syncRoles($salesRole);

        $demoUser = User::updateOrCreate(
            ['email' => 'demo@vybezzzpos.com'],
            [
                'name' => 'Vybezzz POS Demo',
                'password' => Hash::make('TryVybezzz2026!'),
                'username' => 'vybezzz-demo',
                'is_suspended' => false,
            ]
        );
        $demoUser->syncRoles($demoRole);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
