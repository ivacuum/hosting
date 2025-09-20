<?php

namespace Tests\Feature;

use App\Mail\FirstvdsPromocodeMail;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class CouponTest extends TestCase
{
    use DatabaseTransactions;

    public function testFirstvdsPost()
    {
        $email = 'mail@example.com';

        \Mail::fake();

        $this->post('promocodes-coupons/firstvds', ['email' => $email])
            ->assertFound();

        \Mail::assertQueued(FirstvdsPromocodeMail::class, fn (FirstvdsPromocodeMail $mail) => $mail->hasTo($email));
        \Mail::assertOutgoingCount(1);
    }

    #[TestWith(['promocodes-coupons'])]
    #[TestWith(['promocodes-coupons/airbnb'])]
    #[TestWith(['promocodes-coupons/booking'])]
    #[TestWith(['promocodes-coupons/digitalocean'])]
    #[TestWith(['promocodes-coupons/drimsim'])]
    #[TestWith(['promocodes-coupons/firstvds'])]
    #[TestWith(['promocodes-coupons/timeweb'])]
    public function testPages(string $url)
    {
        $this->get($url)
            ->assertOk();
    }
}
