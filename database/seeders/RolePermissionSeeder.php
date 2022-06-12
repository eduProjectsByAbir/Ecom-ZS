<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Create roles
        $roleSuperAdmin = Role::create(['name' => 'admin', 'guard_name' => 'admin']);

        //  permission List as array
        $permissions = [
            [
                'group_name' => 'dashboard',
                'permissions' => [
                    // Dashboard permission
                    'dashboard.view',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    // Role permission
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                ]
            ],
            [
                'group_name' => 'admin_profile',
                'permissions' => [
                    // Profile permission
                    'admin_profile.view',
                    'admin_profile.update',
                    'admin_profile.delete',
                ]
            ],
            [
                'group_name' => 'brand',
                'permissions' => [
                    // Brand permission
                    'brand.view',
                    'brand.create',
                    'brand.store',
                    'brand.edit',
                    'brand.update',
                    'brand.delete',
                ]
            ],
            [
                'group_name' => 'category',
                'permissions' => [
                    // Category permission
                    'category.view',
                    'category.create',
                    'category.store',
                    'category.edit',
                    'category.update',
                    'category.delete',
                ]
            ],
            [
                'group_name' => 'subcategory',
                'permissions' => [
                    // Category permission
                    'subcategory.view',
                    'subcategory.create',
                    'subcategory.store',
                    'subcategory.edit',
                    'subcategory.update',
                    'subcategory.delete',
                ]
            ],
            [
                'group_name' => 'subsubcategory',
                'permissions' => [
                    // Category permission
                    'subsubcategory.view',
                    'subsubcategory.create',
                    'subsubcategory.store',
                    'subsubcategory.edit',
                    'subsubcategory.update',
                    'subsubcategory.delete',
                ]
            ],
            [
                'group_name' => 'product',
                'permissions' => [
                    // product permission
                    'product.view',
                    'product.show',
                    'product.create',
                    'product.store',
                    'product.edit',
                    'product.update',
                    'product.delete',
                ]
            ],
            [
                'group_name' => 'product_image',
                'permissions' => [
                    //image product permission
                    'product_image.create',
                    'product_image.store',
                    'product_image.delete',
                ]
            ],
            [
                'group_name' => 'slider',
                'permissions' => [
                    // slider permission
                    'slider.view',
                    'slider.create',
                    'slider.store',
                    'slider.edit',
                    'slider.update',
                    'slider.delete',
                ]
            ],
            [
                'group_name' => 'coupon',
                'permissions' => [
                    // coupon permission
                    'coupon.view',
                    'coupon.create',
                    'coupon.store',
                    'coupon.edit',
                    'coupon.update',
                    'coupon.delete',
                ]
            ],
        ];

        // Assaign Permission
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];

            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create([
                    'name' => $permissions[$i]['permissions'][$j],
                    'group_name' => $permissionGroup,
                    'guard_name' => 'admin'
                ]);

                $roleSuperAdmin->givePermissionTo($permission);
            }
        }
    }
}
