<?php

namespace App\Console\Commands;

use Ivacuum\Generic\Commands\Command;
use Symfony\Component\Console\Attribute\AsCommand;

use function Laravel\Prompts\note;
use function Laravel\Prompts\password;
use function Laravel\Prompts\suggest;
use function Laravel\Prompts\text;

#[AsCommand('app:shadowsocks-connection-string')]
class ShadowsocksConnectionString extends Command
{
    protected $signature = 'app:shadowsocks-connection-string';
    protected $description = 'Print a connection string for clients';

    public function handle()
    {
        $server = text('What is the server address and port?', 'example.com:12345');
        $cipher = suggest('What is the cipher?', ['aes-256-gcm'], required: true);
        $secret = password('What is the password?', required: true);
        $label = text('What is the server label?', 'test-msk');

        note('ss://' . base64_encode("{$cipher}:{$secret}") . "@{$server}#{$label}");
    }
}
