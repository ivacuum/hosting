<?php namespace App\Seeder;

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
    }
}
