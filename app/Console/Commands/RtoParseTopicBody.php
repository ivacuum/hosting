<?php namespace App\Console\Commands;

use App\Services\Rto;
use Ivacuum\Generic\Commands\Command;

class RtoParseTopicBody extends Command
{
    protected $signature = 'app:parse-topic-body {topicId}';
    protected $description = 'Get html of the rto topic';

    public function handle(Rto $rto)
    {
        dd($rto->parseTopicBody($this->argument('topicId')));
    }
}
