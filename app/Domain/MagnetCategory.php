<?php

namespace App\Domain;

enum MagnetCategory: int
{
    case ForeignCinema = 2;
    case RussianCinema = 3;
    case ForeignTvSeries = 4;
    case RussianTvSeries = 5;
    case Cartoons = 7;
    case CartoonSeries = 8;
    case Anime = 9;

    case ActionGames = 26;
    case RpgGames = 27;
    case ArcadeGames = 28;
    case AdventureGames = 29;
    case SimulatorGames = 30;
    case StrategyGames = 31;
    case OnlineGames = 32;
    case OldGames = 33;
    case OtherGames = 34;

    case Other = 35;

    public function icon(): string
    {
        return match ($this) {
            self::ForeignCinema,
            self::RussianCinema,
            self::Cartoons,
            self::Anime => 'film',

            self::ForeignTvSeries,
            self::RussianTvSeries,
            self::CartoonSeries => 'collection-play',

            self::ActionGames,
            self::RpgGames,
            self::ArcadeGames,
            self::AdventureGames,
            self::SimulatorGames,
            self::StrategyGames,
            self::OnlineGames,
            self::OldGames,
            self::OtherGames => 'gamepad',

            self::Other => 'file-text-o',
        };
    }

    public function title(): string
    {
        return match ($this) {
            self::ForeignCinema => 'Зарубежное кино',
            self::RussianCinema => 'Отечественное кино',
            self::Cartoons => 'Мультфильмы',
            self::Anime => 'Аниме',

            self::ForeignTvSeries => 'Зарубежные сериалы',
            self::RussianTvSeries => 'Русские сериалы',
            self::CartoonSeries => 'Мультсериалы',

            self::ActionGames => 'Action',
            self::RpgGames => 'RPG',
            self::ArcadeGames => 'Аркады',
            self::AdventureGames => 'Приключения и квесты',
            self::SimulatorGames => 'Симуляторы',
            self::StrategyGames => 'Стратегии',
            self::OnlineGames => 'Онлайн игры',
            self::OldGames => 'Старые игры',
            self::OtherGames => 'Другие игры',

            self::Other => 'Прочее',
        };
    }
}
