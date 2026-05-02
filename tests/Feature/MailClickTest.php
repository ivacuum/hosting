<?php

namespace Tests\Feature;

use App\Factory\EmailFactory;
use App\Mail\CommentConfirmMail;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Uri\WhatWg\Url;

class MailClickTest extends TestCase
{
    use DatabaseTransactions;

    public function testAuthenticated()
    {
        $email = EmailFactory::new()
            ->withComment(1)
            ->withTemplate(CommentConfirmMail::class)
            ->create();

        $goto = '/404/';
        $clicks = $email->clicks;

        \Event::fake([
            \App\Events\Stats\MailClicked::class,
            \App\Events\Stats\UserAutologinWithEmailLink::class,
        ]);

        $queryString = Url::parse($email->signedLink($goto))->getQuery();

        $this->get("mail/click/{$email->getTimestamp()}/{$email->id}?{$queryString}")
            ->assertFound()
            ->assertRedirect($goto);

        $email->refresh();

        $this->assertEquals($clicks + 1, $email->clicks);
        $this->assertAuthenticated();

        \Event::assertDispatched(\App\Events\Stats\MailClicked::class);
        \Event::assertDispatched(\App\Events\Stats\UserAutologinWithEmailLink::class);
    }
}
