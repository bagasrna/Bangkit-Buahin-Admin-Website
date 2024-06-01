<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

if (!function_exists('createAndGiveResourcePermission')) {
    function createAndGiveResourcePermission($role, $actions, $rolePermission, $guard)
    {
        collect($rolePermission)->each(function ($permission) use ($role, $actions, $guard) {
            collect($actions)->each(function ($action) use ($role, $permission, $guard) {
                $permission = Permission::query()->firstOrCreate([
                    'name' => "{$action} ${permission}",
                    'guard_name' => $guard
                ]);
                $permission->assignRole($role);
            });
        });
    }
}

if (!function_exists('createAndGivePermission')) {
    function createAndGivePermission($role, $permissions, $guard)
    {
        collect($permissions)->each(function ($permission) use ($role, $guard) {
            $permission = Permission::query()->firstOrCreate(['name' => $permission, 'guard_name' => $guard]);
            $permission->assignRole($role);
        });
    }
}

if (!function_exists('storeImage')) {
    function storeImage(UploadedFile $image = null, $folderLocation)
    {
        if (!$image) {
            return null;
        }

        $fileName = basename($image->getClientOriginalName(), '.' .
            $image->getClientOriginalExtension()) . '-' . now()->timestamp;
        $path = Storage::disk('public')->putFileAs(
            $folderLocation,
            $image,
            Str::slug($fileName) . '.' . $image->getClientOriginalExtension()
        );
        if (!$path) {
            throw new \Exception('An image upload error occurred');
        }

        return $path;
    }
}

if (!function_exists('getStorageAssetFile')) {
    function getStorageAssetFile($path)
    {
        return asset('storage/' . $path);
    }
}
