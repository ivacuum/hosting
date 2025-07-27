<?php

namespace Tests\Feature;

use App\Domain\Game\Factory\GameFactory;
use App\Domain\Game\Models\Game;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GameTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('games')
            ->assertOk()
            ->assertHasCustomTitle();
    }

    public function testShow()
    {
        // С заметкой
        Game::query()
            ->where(['slug' => 'prey'])
            ->firstOr(fn () => GameFactory::new()->withSlug('prey')->create());

        // Без заметки
        GameFactory::new()->create();

        foreach (Game::query()->lazy() as $game) {
            $this->get("games/{$game->slug}")
                ->assertOk()
                ->assertHasCustomTitle();
        }
    }
}
