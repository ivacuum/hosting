<?php namespace App\Console\Commands;

use App\Services\Wanikani\WanikaniClient;
use Ivacuum\Generic\Commands\Command;

class WanikaniSubject extends Command
{
    protected $signature = 'app:wk-subject {id}';
    protected $description = 'Request subject from wanikani.com';

    public function handle(WanikaniClient $api)
    {
        $response = $api->subject($this->argument('id'));

        dump($response->json, $response->subject);
    }
}
