<?php

namespace App\Console\Commands;

use App\Domain\Wanikani\Api\WanikaniApi;
use Ivacuum\Generic\Commands\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:wk-subject')]
class WanikaniSubject extends Command
{
    protected $signature = 'app:wk-subject {id}';
    protected $description = 'Request subject from wanikani.com';

    public function handle(WanikaniApi $wanikani)
    {
        $response = $wanikani->subject($this->argument('id'));

        dump($response->json, $response->subject);
    }
}
