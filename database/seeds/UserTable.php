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

        //  Membuat Data Permision
        Permission::create(['name' => 'master opd create']);
        Permission::create(['name' => 'master opd read']);
        Permission::create(['name' => 'master opd update']);
        Permission::create(['name' => 'master opd delete']);

        Permission::create(['name' => 'tenaga kerja create']);
        Permission::create(['name' => 'tenaga kerja read']);
        Permission::create(['name' => 'tenaga kerja update']);
        Permission::create(['name' => 'tenaga kerja delete']);

        //role administrator diberika semua permission
        $administratorRole = Role::create(['name' => 'administrator']);

        //role admin super
        $adminiSuperRole = Role::create(['name' => 'admin super'])
        ->givePermissionTo( Permission::all() );

        //role admin
        $adminRole = Role::create(['name' => 'admin opd'])
        ->givePermissionTo([
            'tenaga kerja create',
            'tenaga kerja read',
            'tenaga kerja update',
            'tenaga kerja delete'
        ]);

        $user = new User;
        $user->name = 'administrator';
        $user->username = 'administrator';
        $user->email = 'administrator@gmail.com';
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->password = Hash::make('1');
        $user->save();
        $user->assignRole($administratorRole);

        $user = new User;
        $user->name = 'admin super';
        $user->username = 'adminsuper';
        $user->email = 'adminsuper@gmail.com';
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->password = Hash::make('1');
        $user->save();
        $user->assignRole($adminiSuperRole);

        $user = new User;
        $user->name = 'kurob';
        $user->username = 'kurob';
        $user->email = 'kurob@gmail.com';
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->password = Hash::make('1');
        $user->save();
        $user->assignRole($adminRole);

    }
}
