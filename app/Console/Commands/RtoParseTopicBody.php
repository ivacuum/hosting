<?php

namespace App\Console\Commands;

use App\Domain\Rto\Rto;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;

#[Signature('app:parse-topic-body {topicId}')]
#[Description('Get html of the rto topic')]
class RtoParseTopicBody extends Command
{
    public function handle(Rto $rto)
    {
        \Validator::make($this->arguments(), [
            'topicId' => 'required|integer',
        ])->validate();

        dump($rto->parseTopicBody($this->argument('topicId')));

        return self::SUCCESS;
    }
}
