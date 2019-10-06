<?php namespace Tests\Feature;

use App\Http\Controllers\Coupons;
use App\Mail\FirstvdsPromocode;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CouponTest extends TestCase
{
    use DatabaseTransactions;

    public function testFirstvdsPost()
    {
        $email = 'mail@example.com';

        \Mail::fake();

        $this->post(action([Coupons::class, 'firstvdsPost']), ['email' => $email])
            ->assertStatus(302);

        \Mail::assertQueued(FirstvdsPromocode::class, function (FirstvdsPromocode $mail) use ($email) {
            return $mail->hasTo($email);
        });
    }

    /**
     * @dataProvider pages
     * @param string $url
     */
    public function testPages(string $url)
    {
        $this->get($url)
            ->assertStatus(200);
    }

    public function pages()
    {
        return [
            ['/promocodes-coupons'],
            ['/promocodes-coupons/airbnb'],
            ['/promocodes-coupons/booking'],
            ['/promocodes-coupons/digitalocean'],
            ['/promocodes-coupons/drimsim'],
            ['/promocodes-coupons/firstvds'],
            ['/promocodes-coupons/timeweb'],
        ];
    }
}
