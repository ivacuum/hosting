<?php

namespace Tests\Feature;

use App\Domain\Telegram\Api\TelegramResponse;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UploadTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('up')
            ->assertOk();
    }

    public function testStore()
    {
        \Storage::fake('temp');

        \Http::fake([
            ...TelegramResponse::fakeSuccess(),
        ]);

        $file = UploadedFile::fake()->image('example.jpg');

        $this
            ->post('up', [
                'files' => [$file],
            ])
            ->assertRedirect('up')
            ->assertSessionHas('message');

        \Storage::disk('temp')->assertExists(now()->format('Ymd-His') . '-example.jpg');
    }
}
