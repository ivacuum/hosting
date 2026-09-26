<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class DocsTest extends TestCase
{
    #[TestWith(['/docs'])]
    #[TestWith(['/docs/amazon-s3'])]
    #[TestWith(['/docs/freebsd'])]
    #[TestWith(['/docs/nginx'])]
    #[TestWith(['/docs/trips'])]
    public function testGuestCanReadDocumentation(string $url): void
    {
        $this->get($url)->assertOk();
    }
}
