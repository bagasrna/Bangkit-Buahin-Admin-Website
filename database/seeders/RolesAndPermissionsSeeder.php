<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Permission::truncate();
        DB::table('role_has_permissions')->truncate();

        $this->call(PermissionAdminSeeder::class);
        $this->call(PermissionClientSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}

