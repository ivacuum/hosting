<?php

namespace Tests\Feature;

use App\Domain\Exif\Livewire\ExifReader;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DevExifReaderTest extends TestCase
{
    use DatabaseTransactions;

    public function testPage(): void
    {
        $this->get('dev/exif-reader')
            ->assertOk()
            ->assertSeeLivewire(ExifReader::class);
    }
}
