<?php namespace App\Jobs;

use App\Services\Vk;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class LikeVkPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
