<?php namespace Tests\Feature;

use App\Mail\FirstvdsPromocodeMail;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CouponTest extends TestCase
{
    use DatabaseTransactions;

    public function testFirstvdsPost()
    {
        $email = 'mail@example.com';

        \Mail::fake();

        $this->post('promocodes-coupons/firstvds', ['email' => $email])
            ->assertStatus(302);

        \Mail::assertQueued(FirstvdsPromocodeMail::class, fn (FirstvdsPromocodeMail $mail) => $mail->hasTo($email));
    }

    /** @dataProvider pages */
    public function testPages(string $url)
    {
        $this->get($url)
            ->assertOk();
    }

    public function pages()
    {
        yield ['promocodes-coupons'];
        yield ['promocodes-coupons/airbnb'];
        yield ['promocodes-coupons/booking'];
        yield ['promocodes-coupons/digitalocean'];
        yield ['promocodes-coupons/drimsim'];
        yield ['promocodes-coupons/firstvds'];
        yield ['promocodes-coupons/timeweb'];
    }
}
