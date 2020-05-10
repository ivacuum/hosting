<?php namespace App\Seeder;

use App\Factory\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = UserFactory::new()->make();
        $user->email = 'root@example.com';
        $user->login = 'root';
        $user->password = 'top-secret';
        $user->save();

        $user = UserFactory::new()->make();
        $user->email = 'guest@example.com';
        $user->login = 'guest';
        $user->password = 'top-secret';
        $user->save();
    }
}
