<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Permissionseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            'role_create',
            'role_edit',
            'role_delete'
        ];

        foreach ($permission as $permissions) {
            Permission::create(['name' => $permissions, 'guard_name' => 'web']);
        }
    }
}
