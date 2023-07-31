<?php

namespace Tests\Feature;

use App\Action\GetNumberLocalesAction;

trait MockGetNumberLocales
{
    protected function setUpMockGetNumberLocales()
    {
        $this->mock(GetNumberLocalesAction::class)
            ->expects('execute')
            ->andReturn(['de', 'en', 'ko', 'ru']);
    }
}
