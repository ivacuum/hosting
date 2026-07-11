<?php

namespace Tests\Feature;

use App\Factory\UserFactory;
use App\User;

trait BeAdmin
{
    protected User $admin;

    protected function setUpBeAdmin()
    {
        $this->be($this->admin = UserFactory::new()->admin()->create());
    }
}
