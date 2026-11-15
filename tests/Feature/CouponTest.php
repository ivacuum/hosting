<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class CouponTest extends TestCase
{
    use DatabaseTransactions;

    #[TestWith(['promocodes-coupons'])]
    #[TestWith(['promocodes-coupons/airbnb'])]
    #[TestWith(['promocodes-coupons/booking'])]
    #[TestWith(['promocodes-coupons/digitalocean'])]
    #[TestWith(['promocodes-coupons/drimsim'])]
    #[TestWith(['promocodes-coupons/timeweb'])]
    public function testPages(string $url): void
    {
        $this->get($url)
            ->assertOk();
    }
}
