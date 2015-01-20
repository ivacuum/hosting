<?php

function breadcrumbs()
{
	$args = func_get_args();
	$breadcrumbs = [];
	
	for ($i = 0, $len = sizeof($args); $i < $len; $i += 2) {
		$title = $args[$i];
		$url   = $args[$i + 1];
		
		$breadcrumbs[] = (object) compact('title', 'url');
	}
	
	View::share(compact('breadcrumbs'));
}

/**
* Создание ЧПУ ссылки с использованием символов выбранного языка сайта
*
* @param string $url Входная ссылка
*
* @return string $result ЧПУ ссылка
*/
function slug_url($url, $lang = 'ru')
{
	switch ($lang) {
		case 'ru': $pattern = '/[^а-яёa-z\d\.]/u'; break;
		default:   $pattern = '/[^a-z\d\.]/u';
	}

	/* Отсекаем неподходящие символы */
	$result = trim(preg_replace($pattern, '-', mb_strtolower(htmlspecialchars_decode($url))), '-');

	/**
	* Укорачиваем однообразные последовательности символов
	* _. заменяем на _
	* Убираем точку в конце
	*/
	return preg_replace(['/-{2,}/', '/\.{2,}/', '/-\./', '/(.*)\./'], ['-', '', '-', '$1'], $result);
}

/**
* Транслитерация текста (преимущественно для создания папок)
* 
* @param string $string Русский текст в нижнем регистре
* 
* @return string Текст на транслите
*/
function transliterate($string)
{
	return strtr($string, [
		'а' => 'a',
		'б' => 'b',
		'в' => 'v',
		'г' => 'g',
		'д' => 'd',
		'е' => 'e',
		'ё' => 'e',
		'ж' => 'zh',
		'з' => 'z',
		'и' => 'i',
		'й' => 'y',
		'к' => 'k',
		'л' => 'l',
		'м' => 'm',
		'н' => 'n',
		'о' => 'o',
		'п' => 'p',
		'р' => 'r',
		'с' => 's',
		'т' => 't',
		'у' => 'u',
		'ф' => 'f',
		'х' => 'h',
		'ц' => 'c',
		'ч' => 'ch',
		'ш' => 'sh',
		'щ' => 'sch',
		'ъ' => '',
		'ы' => 'y',
		'ь' => '',
		'э' => 'e',
		'ю' => 'yu',
		'я' => 'ya',
	]);
}