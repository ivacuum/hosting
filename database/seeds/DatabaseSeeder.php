<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		Model::unguard();

		// DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		//
		// $this->call('ClientTableSeeder');
		// $this->call('DomainTableSeeder');
		//
		// DB::statement('SET FOREIGN_KEY_CHECKS = 1');
		// $this->call('UserTableSeeder');
	}
}

class ClientTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('clients')->truncate();

		$faker = Faker\Factory::create('ru_RU');
		
		Client::create(['name' => 'Private Person']);
		
		for ($i = 0; $i < 3; $i++) {
			Client::create([
				'name'  => $faker->name('male'),
				'email' => $faker->safeEmail,
			]);
		}
	}
}

class DomainTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('domains')->truncate();

		$faker = Faker\Factory::create('ru_RU');
		
		$domains = ['ivacuum.ru', 'ivacuum.org', 'korden.net', 'ecoprof.su', 'sanpropusknik.com', 'ружейный.рф', 'korden.info'];
		
		foreach ($domains as $domain) {
			Domain::create([
				'client_id'      => $faker->numberBetween(1, 4),
				'domain'         => $domain,
				'active'         => 1,
				'domain_control' => $faker->boolean(85),
			]);
		}
	}
}

class UserTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('users')->truncate();
		
		User::create([
			'email'    => 'root@example.com',
			'password' => 'secret',
		]);
	}
}
