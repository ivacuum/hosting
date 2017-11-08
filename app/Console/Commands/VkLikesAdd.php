<?php namespace App\Console\Commands;

use App\Services\Vk;
use Ivacuum\Generic\Commands\Command;

class VkLikesAdd extends Command
{
    protected $signature = 'app:vk-likes-add {page}';
    protected $description = 'Add VK likes';

    protected $vk;

    public function __construct(Vk $vk)
    {
        parent::__construct();

        $this->vk = $vk;
    }

    public function handle()
    {
        $page = $this->argument('page');
        $access_token = config('services.vk.access_token');

        $this->vk->accessToken($access_token);

        $response = $this->vk->wallSearch($page, ['query' => '#ЛайкТайм', 'count' => 5])->response;

        $i = 0;
        $posts = sizeof($response->items);

        $bar = $this->output->createProgressBar($posts);

        foreach ($response->items as $post) {
            /*
            if (@$post->is_pinned) {
                continue;
            }
            */

            $this->vk->likePost($post->owner_id, $post->id);
            $bar->advance();
            $i++;

            if ($posts !== $i) {
                sleep(10);
            }
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
