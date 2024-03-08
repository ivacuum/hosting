<?php

namespace App;

class FlagCode
{
    public static function fromSlug(string $slug): string
    {
        return match ($slug) {
            'afghanistan' => 'af',
            'albania' => 'al',
            'algeria' => 'dz',
            'andorra' => 'ad',
            'angola' => 'ao',
            'argentina' => 'ar',
            'armenia' => 'am',
            'australia' => 'au',
            'austria' => 'at',
            'azerbaijan' => 'az',
            'belarus' => 'by',
            'belgium' => 'be',
            'bosnia-herzegovina' => 'ba',
            'brazil' => 'br',
            'bulgaria' => 'bg',
            'cambodia' => 'kh',
            'canada' => 'ca',
            'chile' => 'cl',
            'china' => 'cn',
            'colombia' => 'co',
            'croatia' => 'hr',
            'cuba' => 'cu',
            'cyprus' => 'cy',
            'czech-republic',
            'czechia' => 'cz',
            'denmark' => 'dk',
            'ecuador' => 'ec',
            'egypt' => 'eg',
            'estonia' => 'ee',
            'finland' => 'fi',
            'france' => 'fr',
            'georgia' => 'ge',
            'germany' => 'de',
            'greece' => 'gr',
            'greenland' => 'gl',
            'hong-kong' => 'hk',
            'hungary' => 'hu',
            'iceland' => 'is',
            'india' => 'in',
            'indonesia' => 'id',
            'iran' => 'ir',
            'iraq' => 'iq',
            'ireland' => 'ie',
            'israel' => 'il',
            'italy' => 'it',
            'jamaica' => 'jm',
            'japan' => 'jp',
            'jordan' => 'jo',
            'kazakhstan' => 'kz',
            'kyrgyzstan' => 'kg',
            'latvia' => 'lv',
            'liechtenstein' => 'li',
            'lithuania' => 'lt',
            'luxembourg' => 'lu',
            'macedonia' => 'mk',
            'magadascar' => 'mg',
            'malaysia' => 'my',
            'maldives' => 'mv',
            'malta' => 'mt',
            'mexico' => 'mx',
            'moldova' => 'md',
            'monaco' => 'mc',
            'mongolia' => 'mn',
            'montenegro' => 'me',
            'morocco' => 'ma',
            'nepal' => 'np',
            'netherlands' => 'nl',
            'new-zealand' => 'nz',
            'norway' => 'no',
            'oman' => 'om',
            'pakistan' => 'pk',
            'panama' => 'pa',
            'paraguay' => 'py',
            'peru' => 'pe',
            'philippines' => 'ph',
            'poland' => 'pl',
            'portugal' => 'pt',
            'qatar' => 'qa',
            'romania' => 'ro',
            'russia' => 'ru',
            'saudi-arabia' => 'sa',
            'serbia' => 'rs',
            'seychelles' => 'sc',
            'singapore' => 'sg',
            'slovakia' => 'sk',
            'slovenia' => 'si',
            'south-africa' => 'za',
            'south-korea' => 'kr',
            'spain' => 'es',
            'sri-lanka' => 'lk',
            'sudan' => 'sd',
            'sweden' => 'se',
            'switzerland' => 'ch',
            'taiwan' => 'tw',
            'tajikistan' => 'tj',
            'thailand' => 'th',
            'tunisia' => 'tn',
            'turkey' => 'tr',
            'uae' => 'ae',
            'ukraine' => 'ua',
            'united-kingdom' => 'gb',
            'usa' => 'us',
            'uzbekistan' => 'uz',
            'venezuela' => 've',
            'vietnam' => 'vn',
            'yemen' => 'ye',
            'zambia' => 'zm',
            'zimbabwe' => 'zw',
            default => '',
        };
    }
}
