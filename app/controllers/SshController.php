<?php

class SshController extends BaseController
{
	protected $fw = ['drupal', 'fw.dev', 'fw.production', 'fw', 'joomla', 'korden.cms', 'modx', 'netcat', 'simpla', 'wordpress'];
	
	public function index()
	{
		$domain = 'my.korden.net';
		$folder = $domain;
		$aliases = $hostnames = [];
		$dbname = $domain;
		$dbuser = Config::get('database.connections.office.username');
		$dbpass = Config::get('database.connections.office.password');
		$fw = 'fw.production';
		$skeleton = false;
		
		/* база и пользователь БД [3:16 символов] */
		
		$create_nginx_config_file = true;
		$base_dir = "/srv/www/vhosts/{$folder}";
		$chmod = 755;
		$chown = 'developer:devel';
		$nginx_config_file = "/usr/local/etc/nginx/vhosts/{$domain}.conf";
		$skeleton_dir = "/srv/www/vhosts/_/korden.skeleton/stable";
		
		/* поиск выбранного фреймворка */
		
		/* проверка существования скелета */
		
		
		
		/* список фреймворков */
		/* создание папок logs и public_html и директории проекта */
		/* создание базы */
		/* создание пользователя БД со случайным паролем и выдача прав на базу */
		/* шаблон виртуального хоста */
		/* настройка веб-сервера */
		/* печать реквизитов */

		print '<pre>';

		SSH::run([
			"cd /srv/www/vhosts",
			"mkdir -m {$chmod} -p {$domain}/logs",
			"mkdir -m {$chmod} -p {$domain}/public_html",
			"chown -R {$chown} {$domain}",
			// "mysqladmin -u ${dbuser} -p${dbpass} create ${dbname}",
		], function($line) {
			print $line;
		});

	    // $db->do("GRANT ALL PRIVILEGES ON \`${dbname}\`.* TO '${dbname}'\@'localhost' IDENTIFIED BY '${random_password}'");
	    // $db->do("FLUSH PRIVILEGES");
		
		print '</pre>';
	}
	
	public function ftp()
	{
		/*
		$domain = 'my.korden.net';
		$password = Str::random(16);
		$dir = "/srv/www/vhosts/{$domain}";
		$remote_path = "/usr/local/etc/vsftpd/users/{$domain}";
		
		$sql = "INSERT INTO ftp.accounts (username, pass) VALUES (?, PASSWORD(?)) ON DUPLICATE KEY UPDATE pass = values(pass)";
		DB::connection('office')->insert($sql, [$domain, $password]);

		SSH::putString($remote_path, View::make('ssh.ftp')->withDir($dir)->render());
		
		SSH::define('ftp.delete', ["rm {$remote_path}"]);
		*/
	}
	
	public function papertrail()
	{
		// curl -v -H "X-Papertrail-Token: Abo63MMiysrsSk2vrihm" https://papertrailapp.com/api/v1/systems.json
	}
	
	public function hostsite()
	{
	}
}
