<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Ivacuum\Generic\Providers\SpammerTrapTrait;

class ValidatorServiceProvider extends ServiceProvider
{
    use SpammerTrapTrait;

    public function register()
    {
        $this->trap();
    }
}
