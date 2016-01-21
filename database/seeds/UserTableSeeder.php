<?php

use Illuminate\Database\Seeder;
use Delivery\Models\User;
use Delivery\Models\Cliente;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create()->each(function($user){
        	$user->cliente()->save( factory(Cliente::class)->make() );
        });

        factory(User::class, 4)->create([
            'role' => 'deliveryman',
        ]);

        factory(User::class)->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ])->cliente()->save(factory(Cliente::class)->make());

        factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ])->cliente()->save(factory(Cliente::class)->make());

        factory(User::class)->create([
            'name' => 'Deliveryman',
            'email' => 'deliveryman@user.com',
            'role' => 'deliveryman',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ])->cliente()->save(factory(Cliente::class)->make());
    }
}
