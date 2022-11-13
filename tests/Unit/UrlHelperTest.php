<?php namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Ivacuum\Generic\Utilities\UrlHelper;
use Tests\TestCase;

class UrlHelperTest extends TestCase
{
    use DatabaseTransactions;

    public function testSortWithDefaultIdDescending()
    {
        $urlHelper = new UrlHelper;
        $urlHelper->setSortKey('id');
        $urlHelper->setDefaultSortDir('desc');

        $this->assertStringEndsWith('/?sk=id&sd=asc', $urlHelper->sort('id'));
        $this->assertStringEndsWith('/?sk=created_at', $urlHelper->sort('created_at'));
        $this->assertStringEndsWith('/?sk=created_at', $urlHelper->sort('created_at', 'desc'));
        $this->assertStringEndsWith('/?sk=created_at&sd=asc', $urlHelper->sort('created_at', 'asc'));
    }

    public function testSortWithDefaultTitleAscending()
    {
        $urlHelper = new UrlHelper;
        $urlHelper->setSortKey('title');
        $urlHelper->setDefaultSortDir('asc');

        $this->assertStringEndsWith('/?sk=id', $urlHelper->sort('id'));
        $this->assertStringEndsWith('/?sk=id&sd=desc', $urlHelper->sort('id', 'desc'));
        $this->assertStringEndsWith('/?sk=created_at', $urlHelper->sort('created_at'));
        $this->assertStringEndsWith('/?sk=created_at&sd=desc', $urlHelper->sort('created_at', 'desc'));
        $this->assertStringEndsWith('/?sk=created_at', $urlHelper->sort('created_at', 'asc'));
    }
}
