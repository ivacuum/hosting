<?php

namespace App\Console\Commands;

use App\Services\Wanikani\WanikaniApi;
use Ivacuum\Generic\Commands\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:wk-subject', 'Request subject from wanikani.com')]
class WanikaniSubject extends Command
{
    protected $signature = 'app:wk-subject {id}';

    public function handle(WanikaniApi $wanikani)
    {
        $response = $wanikani->subject($this->argument('id'));

        dump($response->json, $response->subject);
    }
}
