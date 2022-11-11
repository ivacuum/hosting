<?php namespace Tests\Feature;

use App\Factory\UserFactory;

trait BeAdmin
{
    protected function setUpBeAdmin()
    {
        $this->be(UserFactory::new()->admin()->make());
    }
}
