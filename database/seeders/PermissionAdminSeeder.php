<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionAdminSeeder extends Seeder
{
    const NAME = 'Admin';
    const GUARD = 'web';
    protected $actions  = [
        'create',
        'view',
        'update',
        'delete'
    ];
    private $resourcePermissions = [
        'address',
        'router',
        'user',
        'profile'
    ];

    private $singlePermissions = [
        'manage firewall',
    ];

    public function run()
    {
        $role = Role::firstOrCreate(['name' => self::NAME, 'guard_name' => self::GUARD]);
        createAndGiveResourcePermission($role, $this->actions, $this->resourcePermissions, self::GUARD);
        createAndGivePermission($role, $this->singlePermissions, self::GUARD);
    }
}