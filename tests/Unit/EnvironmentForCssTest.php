<?php

namespace Tests\Unit;

use App\Utilities\EnvironmentForCss;
use Illuminate\Foundation\Testing\Attributes\UnitTest;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class EnvironmentForCssTest extends TestCase
{
    #[UnitTest]
    #[TestWith([' Edg/130.0.2849.68', 'edge'], 'modern Edge')]
    #[TestWith([' Edge/18.19045', 'edge'], 'legacy Edge')]
    #[TestWith(['', 'chrome'], 'Chrome')]
    public function testDistinguishesEdgeFromChrome(string $suffix, string $expected): void
    {
        $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36' . $suffix;

        $this->assertSame([$expected], new EnvironmentForCss($userAgent)->browserClasses());
    }

    #[UnitTest]
    #[TestWith(['CriOS/130.0.6723.90', 'chrome'], 'Chrome on iOS')]
    #[TestWith(['FxiOS/132.0', 'firefox'], 'Firefox on iOS')]
    #[TestWith(['Version/18.0', 'safari'], 'Safari on iOS')]
    public function testDistinguishesIosBrowsers(string $browserToken, string $expected): void
    {
        $userAgent = "Mozilla/5.0 (iPhone; CPU iPhone OS 18_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) {$browserToken} Mobile/15E148 Safari/604.1";

        $this->assertSame([$expected], new EnvironmentForCss($userAgent)->browserClasses());
    }
}
