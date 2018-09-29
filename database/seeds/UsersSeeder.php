<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        factory(App\User::class)->create([
            'email' => 'root@example.com',
            'login' => 'root',
            'password' => 'secret',
        ]);

        factory(App\User::class)->create([
            'email' => 'guest@example.com',
            'login' => 'guest',
            'password' => 'secret',
        ]);
    }
}
