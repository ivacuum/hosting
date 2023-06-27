<?php

namespace App\Seeder;

use App\FavoriteMovie;
use Illuminate\Database\Seeder;

class FavoriteMovieSeeder extends Seeder
{
    public function run()
    {
        $movie = new FavoriteMovie;
        $movie->year = 1988;
        $movie->kp_id = 22907;
        $movie->title_en = "L'ours";
        $movie->title_ru = 'Медведь';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 1991;
        $movie->kp_id = 444;
        $movie->title_en = 'Terminator 2: Judgement Day';
        $movie->title_ru = 'Терминатор 2: Судный день';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 1993;
        $movie->kp_id = 527;
        $movie->title_en = 'Groundhog Day';
        $movie->title_ru = 'День сурка';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 1996;
        $movie->kp_id = 4343;
        $movie->title_en = 'Kingpin';
        $movie->title_ru = 'Заводила';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 1997;
        $movie->kp_id = 363;
        $movie->title_en = 'L.A. Confidential';
        $movie->title_ru = 'Секреты Лос-Анджелеса';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 1997;
        $movie->kp_id = 12198;
        $movie->title_en = 'The Game';
        $movie->title_ru = 'Игра';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 1998;
        $movie->kp_id = 522;
        $movie->title_en = 'Lock, Stock and Two Smoking Barrels';
        $movie->title_ru = 'Карты, деньги, два ствола';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 1998;
        $movie->kp_id = 4541;
        $movie->title_en = 'The Truman Show';
        $movie->title_ru = 'Шоу Трумана';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 1999;
        $movie->kp_id = 361;
        $movie->title_en = 'Fight Club';
        $movie->title_ru = 'Бойцовский клуб';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 1999;
        $movie->kp_id = 435;
        $movie->title_en = 'The Green Mile';
        $movie->title_ru = 'Зеленая миля';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 1999;
        $movie->kp_id = 395;
        $movie->title_en = 'The Sixth Sense';
        $movie->title_ru = 'Шестое чувство';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2000;
        $movie->kp_id = 627;
        $movie->title_en = 'Cast Away';
        $movie->title_ru = 'Изгой';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2000;
        $movie->kp_id = 526;
        $movie->title_en = 'Snatch';
        $movie->title_ru = 'Большой куш';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2002;
        $movie->kp_id = 324;
        $movie->title_en = 'Catch Me If You Can';
        $movie->title_ru = 'Поймай меня, если сможешь';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2002;
        $movie->kp_id = 496;
        $movie->title_en = 'Minority Report';
        $movie->title_ru = 'Особое мнение';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2004;
        $movie->kp_id = 5492;
        $movie->title_en = 'Eternal Sunshine of the Spotless Mind';
        $movie->title_ru = 'Вечное сияние чистого разума';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2004;
        $movie->kp_id = 6877;
        $movie->title_en = 'Terminal';
        $movie->title_ru = 'Терминал';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2005;
        $movie->kp_id = 86326;
        $movie->title_en = 'Lucky Number Slevin';
        $movie->title_ru = 'Счастливое число Слевина';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2006;
        $movie->kp_id = 102125;
        $movie->title_en = 'Babel';
        $movie->title_ru = 'Вавилон';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2006;
        $movie->kp_id = 126196;
        $movie->title_en = 'Das Leben der Anderen';
        $movie->title_ru = 'Жизнь других';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2006;
        $movie->kp_id = 81314;
        $movie->title_en = 'The Departed';
        $movie->title_ru = 'Отступники';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2006;
        $movie->kp_id = 195334;
        $movie->title_en = 'The Prestige';
        $movie->title_ru = 'Престиж';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2006;
        $movie->kp_id = 243129;
        $movie->title_en = 'Wo ist Fred?';
        $movie->title_ru = 'На колесах';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2007;
        $movie->kp_id = 276295;
        $movie->title_en = 'In Bruges';
        $movie->title_ru = 'Залечь на дно в Брюгге';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2007;
        $movie->kp_id = 252626;
        $movie->title_en = 'Into the Wild';
        $movie->title_ru = 'В диких условиях';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2007;
        $movie->kp_id = 252900;
        $movie->title_en = 'The Man from Earth';
        $movie->title_ru = 'Человек с Земли';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2007;
        $movie->kp_id = 195434;
        $movie->title_en = 'No Country for Old Men';
        $movie->title_ru = 'Старикам тут не место';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2007;
        $movie->kp_id = 306084;
        $movie->title_en = 'The Big Bang Theory';
        $movie->title_ru = 'Теория большого взрыва';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2008;
        $movie->kp_id = 391735;
        $movie->title_en = "Bienvenue chez les Ch'tis";
        $movie->title_ru = 'Бобро поржаловать!';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2008;
        $movie->kp_id = 404900;
        $movie->title_en = 'Breaking Bad';
        $movie->title_ru = 'Во все тяжкие';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2008;
        $movie->kp_id = 111543;
        $movie->title_en = 'The Dark Knight';
        $movie->title_ru = 'Темный рыцарь';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2008;
        $movie->kp_id = 391772;
        $movie->title_en = 'Yes Man';
        $movie->title_ru = 'Всегда говори «ДА»';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2008;
        $movie->kp_id = 279102;
        $movie->title_en = 'WALL·E';
        $movie->title_ru = 'ВАЛЛ·И';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2008;
        $movie->kp_id = 409507;
        $movie->title_en = 'Yip Man';
        $movie->title_ru = 'Ип Ман';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2009;
        $movie->kp_id = 423210;
        $movie->title_en = '3 Idiots';
        $movie->title_ru = 'Три идиота';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2010;
        $movie->kp_id = 581145;
        $movie->title_en = 'Exporting Raymond';
        $movie->title_ru = 'Экспорт Рэймонда';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2010;
        $movie->kp_id = 447301;
        $movie->title_en = 'Inception';
        $movie->title_ru = 'Начало';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2010;
        $movie->kp_id = 502838;
        $movie->title_en = 'Sherlock';
        $movie->title_ru = 'Шерлок';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2010;
        $movie->kp_id = 497882;
        $movie->title_en = 'Zero II';
        $movie->title_ru = 'Зеро 2';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2011;
        $movie->kp_id = 655800;
        $movie->title_en = 'Black Mirror';
        $movie->title_ru = 'Черное зеркало';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2011;
        $movie->kp_id = 574497;
        $movie->title_en = 'Bron/Broen';
        $movie->title_ru = 'Мост';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2011;
        $movie->kp_id = 574688;
        $movie->title_en = 'Homeland';
        $movie->title_ru = 'Родина';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2011;
        $movie->kp_id = 535341;
        $movie->title_en = 'Intouchables';
        $movie->title_ru = '1+1';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2011;
        $movie->kp_id = 472362;
        $movie->title_en = 'Mission: Impossible - Ghost Protocol';
        $movie->title_ru = 'Миссия невыполнима: Протокол Фантом';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2011;
        $movie->kp_id = 571335;
        $movie->title_en = 'Shameless';
        $movie->title_ru = 'Бесстыдники';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2011;
        $movie->kp_id = 557806;
        $movie->title_en = 'Suits';
        $movie->title_ru = 'Форс-мажоры';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2011;
        $movie->kp_id = 484474;
        $movie->title_en = 'The Guard';
        $movie->title_ru = 'Однажды в Ирландии';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2012;
        $movie->kp_id = 760829;
        $movie->title_en = 'Coherence';
        $movie->title_ru = 'Связь';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2013;
        $movie->kp_id = 260162;
        $movie->title_en = 'Dallas Buyers Club';
        $movie->title_ru = 'Далласский клуб покупателей';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2013;
        $movie->kp_id = 577488;
        $movie->title_en = 'Her';
        $movie->title_ru = 'Она';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2013;
        $movie->kp_id = 581937;
        $movie->title_en = 'House of Cards';
        $movie->title_ru = 'Карточный домик';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2013;
        $movie->kp_id = 772017;
        $movie->title_en = 'Mandariinid';
        $movie->title_ru = 'Мандарины';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2013;
        $movie->kp_id = 725190;
        $movie->title_en = 'Whiplash';
        $movie->title_ru = 'Одержимость';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2014;
        $movie->kp_id = 722827;
        $movie->title_en = 'Birdman';
        $movie->title_ru = 'Бёрдмэн';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2014;
        $movie->kp_id = 505851;
        $movie->title_en = 'Edge of Tomorrow';
        $movie->title_ru = 'Грань будущего';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2014;
        $movie->kp_id = 767379;
        $movie->title_en = 'Fargo';
        $movie->title_ru = 'Фарго';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2014;
        $movie->kp_id = 692861;
        $movie->title_en = 'Gone Girl';
        $movie->title_ru = 'Исчезнувшая';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2014;
        $movie->kp_id = 258687;
        $movie->title_en = 'Interstellar';
        $movie->title_ru = 'Интерстеллар';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2014;
        $movie->kp_id = 775727;
        $movie->title_en = 'Relatos salvajes';
        $movie->title_ru = 'Дикие истории';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2014;
        $movie->kp_id = 723959;
        $movie->title_en = 'Silicon Valley';
        $movie->title_ru = 'Кремниевая долина';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2014;
        $movie->kp_id = 681831;
        $movie->title_en = 'True Detective';
        $movie->title_ru = 'Настоящий детектив';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2014;
        $movie->kp_id = 462682;
        $movie->title_en = 'Wolf of Wall Street';
        $movie->title_ru = 'Волк с Уолл-стрит';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2015;
        $movie->kp_id = 645118;
        $movie->title_en = 'Inside Out';
        $movie->title_ru = 'Головоломка';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2015;
        $movie->kp_id = 749540;
        $movie->title_en = 'Kingsman: The Secret Service';
        $movie->title_ru = 'Kingsman: Секретная служба';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2015;
        $movie->kp_id = 821565;
        $movie->title_en = 'Narcos';
        $movie->title_ru = 'Нарко';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2016;
        $movie->kp_id = 778218;
        $movie->title_en = 'Hardcore Henry';
        $movie->title_ru = 'Хардкор';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2016;
        $movie->kp_id = 462649;
        $movie->title_en = 'The Night Manager';
        $movie->title_ru = 'Ночной администратор';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2016;
        $movie->kp_id = 195523;
        $movie->title_en = 'Westworld';
        $movie->title_ru = 'Мир Дикого Запада';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2017;
        $movie->kp_id = 582358;
        $movie->title_en = '13 Reasons Why';
        $movie->title_ru = '13 причин почему';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2017;
        $movie->kp_id = 837552;
        $movie->title_en = 'American Made';
        $movie->title_ru = 'Сделано в Америке';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2017;
        $movie->kp_id = 848297;
        $movie->title_en = 'Sneaky Pete';
        $movie->title_ru = 'Подлый Пит';
        $movie->is_tv_series = 1;
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2017;
        $movie->kp_id = 1008113;
        $movie->title_en = 'Taeksi unjeonsa';
        $movie->title_ru = 'Таксист';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2017;
        $movie->kp_id = 828242;
        $movie->title_en = 'The Disaster Artist';
        $movie->title_ru = 'Горе-творец';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2018;
        $movie->kp_id = 1176115;
        $movie->title_en = 'Bodyguard';
        $movie->title_ru = 'Телохранитель';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2019;
        $movie->kp_id = 1188529;
        $movie->title_en = 'Knives Out';
        $movie->title_ru = 'Достать ножи';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2019;
        $movie->kp_id = 1143242;
        $movie->title_en = 'The Gentlemen';
        $movie->title_ru = 'Джентльмены';
        $movie->save();

        $movie = new FavoriteMovie;
        $movie->year = 2019;
        $movie->kp_id = 462305;
        $movie->title_en = 'The Irishman';
        $movie->title_ru = 'Ирландец';
        $movie->save();
    }
}
