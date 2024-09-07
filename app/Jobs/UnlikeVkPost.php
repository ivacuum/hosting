<?php

namespace App\Jobs;

use App\Domain\Config;
use App\Services\Vk;

class UnlikeVkPost extends AbstractJob
{
    public function __construct(private Vk\Post $post) {}

    public function handle(Vk $vk)
    {
        $vk->accessToken(Config::VkAccessToken->get())
            ->unlikePost($this->post);
    }
}
