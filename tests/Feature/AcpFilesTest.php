<?php

namespace Tests\Feature;

use App\Domain\FileStatus;
use App\Factory\FileFactory;
use App\File;
use App\Http\Livewire\Acp\FileForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AcpFilesTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->get('acp/files/create')
            ->assertOk()
            ->assertSeeLivewire(FileForm::class);
    }

    public function testEdit()
    {
        $file = FileFactory::new()->create();

        $this->get("acp/files/{$file->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(FileForm::class);
    }

    public function testIndex()
    {
        FileFactory::new()->create();

        $this->get('acp/files')
            ->assertOk();
    }

    public function testShow()
    {
        $file = FileFactory::new()->create();

        $this->get("acp/files/{$file->id}")
            ->assertOk();
    }

    public function testStore()
    {
        \Storage::fake('files');
        \Storage::fake('tmp-for-tests');

        $file = FileFactory::new()->make();
        $uploadedFile = UploadedFile::fake()->image('IMG_0025.jpeg');

        \Livewire::test(FileForm::class, ['file' => new File])
            ->set('file.title', $file->title)
            ->set('file.slug', $file->slug)
            ->set('upload', $uploadedFile)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/files');

        $this->get('acp/files')
            ->assertSee($file->title);

        \Storage::disk('files')->assertExists("{$file->slug}.jpg");
    }

    public function testUpdate()
    {
        $file = FileFactory::new()->create();

        \Livewire::test(FileForm::class, ['file' => $file])
            ->set('file.title', 'Our File 📁')
            ->set('file.status', FileStatus::Hidden)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/files');

        $file->refresh();

        $this->assertSame('Our File 📁', $file->title);
        $this->assertSame(FileStatus::Hidden, $file->status);
    }
}
