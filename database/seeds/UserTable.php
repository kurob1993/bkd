<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Membuat Data Permision
        Permission::create(['name' => 'create materis']);
        Permission::create(['name' => 'read materis']);
        Permission::create(['name' => 'update materis']);
        Permission::create(['name' => 'delete materis']);

        //role administrator diberika semua permission
        $adminisRole = Role::create(['name' => 'administrator'])
        ->givePermissionTo( Permission::all() );

        //role admin
        $adminRole = Role::create(['name' => 'admin'])
        ->givePermissionTo([
            'create materis',
            'read materis',
            'update materis',
            'delete materis'
        ]);

        $user = new User;
        $user->name = 'administrator';
        $user->username = 'administrator';
        $user->email = 'administrator@gmail.com';
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->password = Hash::make('1');
        $user->save();
        $user->assignRole($adminisRole);//tandai sebagai administrator

        $user = new User;
        $user->name = 'kurob';
        $user->username = 'kurob';
        $user->email = 'kurob@gmail.com';
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->password = Hash::make('1');
        $user->save();
        $user->assignRole($adminRole);//tandai sebagai admin

    }
}
