<?php

namespace App\Console\Commands;

use App\Services\Rto;
use Ivacuum\Generic\Commands\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:parse-topic-body', 'Get html of the rto topic')]
class RtoParseTopicBody extends Command
{
    protected $signature = 'app:parse-topic-body {topicId}';

    public function handle(Rto $rto)
    {
        \Validator::make($this->arguments(), [
            'topicId' => 'required|integer',
        ])->validate();

        dump($rto->parseTopicBody($this->argument('topicId')));

        return self::SUCCESS;
    }
}
