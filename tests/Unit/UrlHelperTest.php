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

        $this->assertStringEndsWith('/?sk=id', $urlHelper->sort('id'));
        $this->assertStringEndsWith('/?sk=-created_at', $urlHelper->sort('created_at'));
        $this->assertStringEndsWith('/?sk=-created_at', $urlHelper->sort('created_at', 'desc'));
        $this->assertStringEndsWith('/?sk=created_at', $urlHelper->sort('created_at', 'asc'));
    }

    public function testSortWithDefaultTitleAscending()
    {
        $urlHelper = app(UrlHelper::class);
        $urlHelper->setSort(Sort::asc('title'));

        $this->assertStringEndsWith('/?sk=-title', $urlHelper->sort('title'));
        $this->assertStringEndsWith('/?sk=-title', $urlHelper->sort('title', 'desc'));
        $this->assertStringEndsWith('/?sk=-title', $urlHelper->sort('title', 'asc'));
        $this->assertStringEndsWith('/?sk=created_at', $urlHelper->sort('created_at'));
        $this->assertStringEndsWith('/?sk=-created_at', $urlHelper->sort('created_at', 'desc'));
        $this->assertStringEndsWith('/?sk=created_at', $urlHelper->sort('created_at', 'asc'));

        request()->merge(['sk' => '-title']);

        $this->assertStringEndsWith('/?sk=title', $urlHelper->sort('title'));
        $this->assertStringEndsWith('/?sk=title', $urlHelper->sort('title', 'desc'));
        $this->assertStringEndsWith('/?sk=title', $urlHelper->sort('title', 'asc'));
    }
}
