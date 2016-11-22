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

        $response = $this->vk->wallGet($page, ['count' => 50])->response;

        $bar = $this->output->createProgressBar(sizeof($response->items));

        foreach ($response->items as $post) {
            $this->vk->likePost($post->owner_id, $post->id);
            $bar->advance();
            sleep(1);
        }

        $bar->finish();
        $this->output->writeln('');
    }
}
