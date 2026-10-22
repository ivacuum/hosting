<?php

namespace Tests\Feature;

use App\Factory\FileFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FileTest extends TestCase
{
    use DatabaseTransactions;

    public function testDownload(): void
    {
        $file = FileFactory::new()->create();
        $downloads = $file->downloads;

        $this->get("files/{$file->id}/dl")
            ->assertRedirect($file->downloadPath());

        $file->refresh();

        $this->assertEquals($downloads + 1, $file->downloads);
    }

    public function testIndex(): void
    {
        $this->get('files')
            ->assertOk();
    }
}
