<?php namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Ivacuum\Generic\Jobs\SendTelegramMessageJob;
use Tests\TestCase;

class CiBuildNotifyTest extends TestCase
{
    use DatabaseTransactions;

    public function testFailed()
    {
        \Queue::fake();

        $this
            ->post('internal/ci-build-notifier', [
                'name' => 'project',
                'build' => [
                    'number' => 222,
                    'status' => 'failed',
                ],
            ])
            ->assertOk();

        \Queue::assertPushed(SendTelegramMessageJob::class);
    }

    public function testSuccess()
    {
        \Queue::fake();

        $this
            ->post('internal/ci-build-notifier', [
                'name' => 'project',
                'build' => [
                    'number' => 333,
                    'status' => 'success',
                ],
            ])
            ->assertOk();

        \Queue::assertPushed(SendTelegramMessageJob::class);
    }
}
