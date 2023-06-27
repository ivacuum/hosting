<?php

namespace App\Console\Commands;

use App\Jobs\LikeVkPost;
use App\Services\Vk;
use Carbon\CarbonInterval;
use Ivacuum\Generic\Commands\Command;

class VkLikesAdd extends Command
{
    protected $signature = 'app:vk-likes-add {page}';
    protected $description = 'Add VK likes';

    public function handle(Vk $vk)
    {
        $page = $this->argument('page');

        $vk->accessToken(config('services.vk.access_token'));

        // $response = $vk->wallSearch($page, ['query' => '#ЛайкТайм', 'count' => 5])->response;
        $response = $vk->wallGet($page, ['count' => 10])->response;

        $i = 0;
        $bar = $this->output->createProgressBar(count($response->items));

        foreach ($response->items as $postJson) {
            $post = Vk\Post::fromJson($postJson);

            if ($post->isPinned() || $post->isAd() || !$post->canLike() || $post->isUserLiked()) {
                continue;
            }

            LikeVkPost::dispatch($post)
                ->delay(CarbonInterval::seconds(10 * $i));

            $bar->advance();
            $i++;
        }

        $bar->finish();
        $this->output->writeln('');
    }
}

/*
var response = API.wall.get({"v": "5.60", "count": 10, "domain": "{$page}"});

response.items.shift();

while (response.items.length) {
  var item = response.items.shift();
  API.likes.add({"v": "5.60", "type": "post", "owner_id": item.owner_id, "item_id": item.id});
}

return 1;
*/
