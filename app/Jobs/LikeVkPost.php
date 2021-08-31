<?php namespace App\Jobs;

use App\Services\Vk;

class LikeVkPost extends AbstractJob
{
    public function __construct(private Vk\Post $post)
    {
    }

    public function handle(Vk $vk)
    {
        $vk->accessToken(config('services.vk.access_token'))
            ->likePost($this->post);
    }
}
