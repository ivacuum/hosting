<?php namespace App\Jobs;

use App\Services\Vk;

class UnlikeVkPost extends AbstractJob
{
    protected $post;

    public function __construct(Vk\Post $post)
    {
        $this->post = $post;
    }

    public function handle(Vk $vk)
    {
        $vk->accessToken(config('services.vk.access_token'))
            ->unlikePost($this->post);
    }
}
