<?php

namespace Tests\Feature;

use App\Factory\EmailFactory;
use App\Factory\UserFactory;
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

    public function testInvalidSignaturesAllowSameOriginRedirectsWithoutAuthentication(): void
    {
        $email = EmailFactory::new()->withUser(UserFactory::new()->inactive())->create();
        $clicks = $email->clicks;

        $queries = [
            ['goto' => '/my?tab=profile#name'],
            ['goto' => 'http://localhost/my?tab=profile#name', 'signature' => 'invalid'],
        ];

        foreach ($queries as $query) {
            $this->get("mail/click/{$email->getTimestamp()}/{$email->id}?" . http_build_query($query))
                ->assertRedirect('http://localhost/my?tab=profile#name');

            $this->assertGuest();
        }

        $this->assertSame($clicks, $email->fresh()->clicks);
        $this->assertFalse($email->user->fresh()->isActive());
    }

    public function testRejectsUnsignedAndTamperedExternalLinks(): void
    {
        $email = EmailFactory::new()->withUser()->create();

        $destinations = [
            'https://example.com',
            '//example.com',
            '/\\example.com',
            'http://localhost@example.com',
            'javascript:alert(1)',
            'http://localhost:8080/my',
        ];

        $links = array_map(
            static fn (string $goto): string => "mail/click/{$email->getTimestamp()}/{$email->id}?" . http_build_query(['goto' => $goto]),
            $destinations,
        );
        $links[] = $email->signedLink('/my') . '&' . http_build_query(['goto' => 'https://example.com']);

        foreach ($links as $link) {
            $this->get($link)
                ->assertForbidden()
                ->assertHeaderMissing('Location');
        }

        $this->assertGuest();
    }
}
