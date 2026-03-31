<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;

use function Laravel\Prompts\note;
use function Laravel\Prompts\password;
use function Laravel\Prompts\suggest;
use function Laravel\Prompts\text;

#[Signature('app:shadowsocks-connection-string')]
#[Description('Print a connection string for clients')]
class ShadowsocksConnectionString extends Command
{
    public function handle()
    {
        $server = text('What is the server address and port?', 'example.com:12345');
        $cipher = suggest('What is the cipher?', ['aes-256-gcm'], required: true);
        $secret = password('What is the password?', required: true);
        $label = rawurlencode(text('What is the server label?', 'test-msk'));

        note('ss://' . base64_encode("{$cipher}:{$secret}") . "@{$server}#{$label}");
    }
}
