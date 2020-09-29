<?php namespace App\Jobs;

use App\Services\Vk;

class LikeVkPost extends AbstractJob
{
    protected $post;

    public function __construct(Vk\Post $post)
    {
        $this->post = $post;
    }

    public function handle(Vk $vk)
    {
        $vk->accessToken(config('services.vk.access_token'))
            ->likePost($this->post);
    }
}
