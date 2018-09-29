<?php namespace Tests\Feature;

use App\File;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FileTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get(action('Files@index'))
            ->assertStatus(200);
    }

    public function testDownload()
    {
        /* @var File $file */
        $file = factory(File::class)->create();
        $downloads = $file->downloads;

        $this->get(action('Files@download', $file))
            ->assertRedirect($file->downloadPath());

        $file->refresh();

        $this->assertEquals($downloads + 1, $file->downloads);
    }
}
