<?php

namespace Tests\Unit;

use App\Domain\Sort;
use App\Utilities\UrlHelper;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UrlHelperTest extends TestCase
{
    use DatabaseTransactions;

    public function testSortWithDefaultIdDescending()
    {
        $urlHelper = app(UrlHelper::class);
        $urlHelper->setSort(Sort::desc('id'));

        $this->assertSame('http://localhost?sk=id', $urlHelper->sort('id'));
        $this->assertSame('http://localhost?sk=-created_at', $urlHelper->sort('created_at'));
        $this->assertSame('http://localhost?sk=-created_at', $urlHelper->sort('created_at', 'desc'));
        $this->assertSame('http://localhost?sk=created_at', $urlHelper->sort('created_at', 'asc'));
    }

    public function testSortWithDefaultTitleAscending()
    {
        $urlHelper = app(UrlHelper::class);
        $urlHelper->setSort(Sort::asc('title'));

        $this->assertSame('http://localhost?sk=-title', $urlHelper->sort('title'));
        $this->assertSame('http://localhost?sk=-title', $urlHelper->sort('title', 'desc'));
        $this->assertSame('http://localhost?sk=-title', $urlHelper->sort('title', 'asc'));
        $this->assertSame('http://localhost?sk=created_at', $urlHelper->sort('created_at'));
        $this->assertSame('http://localhost?sk=-created_at', $urlHelper->sort('created_at', 'desc'));
        $this->assertSame('http://localhost?sk=created_at', $urlHelper->sort('created_at', 'asc'));

        request()->merge(['sk' => '-title']);

        $this->assertSame('http://localhost?sk=title', $urlHelper->sort('title'));
        $this->assertSame('http://localhost?sk=title', $urlHelper->sort('title', 'desc'));
        $this->assertSame('http://localhost?sk=title', $urlHelper->sort('title', 'asc'));
    }
}
