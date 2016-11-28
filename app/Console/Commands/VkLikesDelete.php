<?php namespace App\Console\Commands;

use App\Services\Vk;

class VkLikesDelete extends Command
{
    protected $signature = 'app:vk-likes-delete {page}';
    protected $description = 'Delete VK likes';

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

        $response = $this->vk->wallGet($page, ['count' => 8])->response;

        $bar = $this->output->createProgressBar(sizeof($response->items));

        $this->vk->accessToken($access_token);

        foreach ($response->items as $post) {
            if (@$post->is_pinned) {
                continue;
            }

            $this->vk->unlikePost($post->owner_id, $post->id);
            $bar->advance();
            sleep(10);
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
  API.likes.delete({"v": "5.60", "type": "post", "owner_id": item.owner_id, "item_id": item.id});
}

return 1;
*/
