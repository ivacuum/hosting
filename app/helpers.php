<?php

/**
* Преобразует
* IMG_1063.jpg;1000x750;59.8690305556 30.3306222222
* в массив src, width, height, latitude, longitude
*/
function parse_carousel_image_string($string)
{
	$w = $h = $lat = $lon = '';
	
	@list($src, $size, $coord) = explode(';', $string);
	
	if (!empty($size)) {
		list($w, $h) = explode('x', $size);
	}
	
	if (!empty($coord)) {
		list($lat, $lon) = explode(' ', $coord);
	}
	
	return compact('src', 'w', 'h', 'lat', 'lon');
}
