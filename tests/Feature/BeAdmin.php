<?php

namespace Tests\Feature;

use App\User;

trait BeAdmin
{
    protected User $admin;

    protected function setUpBeAdmin()
    {
        $this->be($this->admin = User::query()->findOrFail(1));
    }
}
