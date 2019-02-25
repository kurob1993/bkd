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

        //materi
        Permission::create(['name' => 'create materis']);
        Permission::create(['name' => 'read materis']);
        Permission::create(['name' => 'update materis']);
        Permission::create(['name' => 'delete materis']);
        //partisipan
        Permission::create(['name' => 'create partisipans']);
        Permission::create(['name' => 'read partisipans']);
        Permission::create(['name' => 'update partisipans']);
        Permission::create(['name' => 'delete partisipans']);
        //notulis
        Permission::create(['name' => 'create notulens']);
        Permission::create(['name' => 'read notulens']);
        Permission::create(['name' => 'update notulens']);
        Permission::create(['name' => 'delete notulens']);
        //pic
        Permission::create(['name' => 'create pic']);
        Permission::create(['name' => 'read pic']);
        Permission::create(['name' => 'update pic']);
        Permission::create(['name' => 'delete pic']);

        //role administrator mendapat semua permission
        $adminisRole = Role::create(['name' => 'administrator'])
        ->givePermissionTo( Permission::all() );

        //role admin
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

            'create notulens',
            'delete notulens'
        ]);

        //role user
        $userRole = Role::create(['name' => 'user'])
        ->givePermissionTo([
            'read materis',
            'read partisipans'
        ]);

        //role notulis
        $notulisRole = Role::create(['name' => 'notulis'])
        ->givePermissionTo([
            'read materis',
            'read partisipans',
            'create notulens',
            'read notulens',
            'update notulens',
            'delete notulens'
        ]);

        //role pic
        $picRole = Role::create(['name' => 'pic'])
        ->givePermissionTo([
            'read materis',
            'read partisipans',
            'create pic',
            'read pic',
            'update pic',
            'delete pic'
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

        // user anonimus1
        for ($i=0; $i < 5; $i++) { 
            $user = new User;
            $user->name = 'user'.($i+1);
            $user->username = 'user'.($i+1);
            $user->email = 'user'.($i+1).'@gmail.com';
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->password = Hash::make('1');
            $user->save();
            if($i == 0){
                $user->assignRole($adminRole);//hanya mendapat permission read materis
            }
            $user->assignRole($userRole);//hanya mendapat permission read materis
        }

    }
}
