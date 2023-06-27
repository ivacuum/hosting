<?php

namespace App\Jobs;

use App\Services\Vk;

class UnlikeVkPost extends AbstractJob
{
    public function __construct(private Vk\Post $post)
    {
    }

    public function handle(Vk $vk)
    {
        $vk->accessToken(config('services.vk.access_token'))
            ->unlikePost($this->post);
    }
}
