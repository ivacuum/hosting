<?php namespace App\Console\Commands;

use App\Services\Vk;

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

        $code = <<<"CODE"
var response = API.wall.get({"v": "5.60", "count": 10, "domain": "{$page}"});

response.items.shift();

while (response.items.length) {
  var item = response.items.shift();
  API.likes.add({"v": "5.60", "type": "post", "owner_id": item.owner_id, "item_id": item.id});
}

return 1;
CODE;

        $response = $this->vk->execute($code);

        $this->info(json_encode($response));
    }
}
