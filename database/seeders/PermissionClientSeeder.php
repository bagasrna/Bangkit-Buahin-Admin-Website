<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionClientSeeder extends Seeder
{
    const NAME = 'Client';
    const GUARD = 'web';
    protected $actions  = [
        'create',
        'view',
        'update',
        'delete'
    ];
    private $resourcePermissions = [
        'address',
        'profile'
    ];

    private $singlePermissions = [
        'view router',
    ];


    public function run()
    {
        $role = Role::firstOrCreate(['name' => self::NAME, 'guard_name' => self::GUARD]);
        createAndGiveResourcePermission($role, $this->actions, $this->resourcePermissions, self::GUARD);
        createAndGivePermission($role, $this->singlePermissions, self::GUARD);
    }
}
