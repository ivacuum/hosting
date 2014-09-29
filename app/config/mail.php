<?php

return [
	/* smtp, mail, sendmail, mailgun, mandrill, log */
	'driver'     => 'smtp',
	'host'       => 'smtp.yandex.ru',
	'port'       => 465,
	'from'       => ['address' => 'noreply@ivacuum.ru', 'name' => null],
	'encryption' => 'ssl',
	'username'   => 'noreply@ivacuum.ru',
	'password'   => 'xxg23hmXYUwGTL',
	'sendmail'   => '/usr/sbin/sendmail -bs',
	'pretend'    => false,
];
