<?php

namespace App\Console\Commands;

use App\Domain\Wanikani\Api\WanikaniApi;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;

#[Signature('app:wk-subject {id}')]
#[Description('Request subject from wanikani.com')]
class WanikaniSubject extends Command
{
    public function handle(WanikaniApi $wanikani)
    {
        $response = $wanikani->subject($this->argument('id'));

        dump($response->json, $response->subject);
    }
}
