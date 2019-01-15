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

        $materiPermission = Permission::create(['name' => 'create materis']);
        $materiPermission = Permission::create(['name' => 'read materis']);
        $materiPermission = Permission::create(['name' => 'update materis']);
        $materiPermission = Permission::create(['name' => 'delete materis']);

        $materiPermission = Permission::create(['name' => 'create partisipans']);
        $materiPermission = Permission::create(['name' => 'read partisipans']);
        $materiPermission = Permission::create(['name' => 'update partisipans']);
        $materiPermission = Permission::create(['name' => 'delete partisipans']);

        $notulisPermission = Permission::create(['name' => 'create notuliss']);
        $notulisPermission = Permission::create(['name' => 'read notuliss']);
        $notulisPermission = Permission::create(['name' => 'update notuliss']);
        $notulisPermission = Permission::create(['name' => 'delete notuliss']);

        //role administrator mendapat semua permission
        $adminisRole = Role::create(['name' => 'administrator'])
        ->givePermissionTo( Permission::all() );
        $materiPermission->assignRole($adminisRole);

        $user = new User;
        $user->name = 'administrator';
        $user->username = 'administrator';
        $user->email = 'administrator@gmail.com';
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->password = Hash::make('1');
        $user->save();
        $user->assignRole($adminisRole);//tandai sebagai administrator

        //role admin mendapatkan CRUD maateri
        $adminRole = Role::create(['name' => 'admin'])
        ->givePermissionTo([
            'create materis',
            'read materis',
            'update materis',
            'delete materis',
            'create partisipans',
            'read partisipans',
            'update partisipans',
            'delete partisipans',
            'create notuliss',
            'read notuliss',
            'update notuliss',
            'delete notuliss'
        ]);
        $materiPermission->assignRole($adminRole);

        $user = new User;
        $user->name = 'kurob';
        $user->username = 'kurob';
        $user->email = 'kurob@gmail.com';
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->password = Hash::make('1');
        $user->save();
        $user->assignRole($adminRole);//tandai sebagai admin
        
        //role admin mendapatkan CRUD maateri
        $userRole = Role::create(['name' => 'user'])
        ->givePermissionTo([
            'read materis',
            'create partisipans'
        ]);

        // user anonimus1
        
        for ($i=0; $i < 5; $i++) { 
            $user = new User;
            $user->name = 'user'.($i+1);
            $user->username = 'user'.($i+1);
            $user->email = 'user'.($i+1).'@gmail.com';
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->password = Hash::make('1');
            $user->save();
            $user->assignRole($userRole);//hanya mendapat permission read materis
        }

    }
}
