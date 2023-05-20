<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crudPermissionNames = [
            'Manage admins' => ' أدراة المدراء',
            'Manage roles' => ' أدراة الأدوار والصلاحيات',
            'Manage categories' => 'أدراة الأقسام',
            'Manage users' => 'أدراة المستخدمين',
            'Manage ads' => 'أدراة الاعلانات',
            'Manage contact_us' => 'أدراة تواصل معانا',
            'Manage pages' => 'أدراة الصفحات',
            'Manage discounts' => 'أدراة أكواد الخصم',
            'Manage settings' => 'أدارة الاعدادات',
            "Manage cities" => 'ادراة المدن',
            "Manage skills" => 'ادراة المهارات',
            "Manage money" => 'ادارة الميزانية المتوقعة',
            "Manage medals" => 'ادارة الاوسمة',
            'Manage features' => 'ادارة مميزات الباقة',
            'Manage packages' => 'ادارة الباقات'
        ];

        foreach ($crudPermissionNames as $en_permission => $ar_permission) {
            Permission::updateOrCreate(
                [
                    'name' => $en_permission,
                    'name_ar' => $ar_permission,
                    'guard_name' => 'admin',
                ],
                [
                    'name' => $en_permission,
                    'name_ar' => $ar_permission,
                    'guard_name' => 'admin',
                ]
            );
        }

        $role = Role::where(['name' => 'super admin', 'guard_name' => 'admin'])->first();

        $role->givePermissionTo(Permission::where('guard_name', 'admin')->pluck('id'));
    }
}
