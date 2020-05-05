<?php

namespace JPeters\PageViewBuilder\Tests;

use JPeters\PageViewBuilder\AbstractPage;
use JPeters\PageViewBuilder\PageViewBuilder;
use JPeters\PageViewBuilder\Page;

class PageViewInstanceTest extends TestCase
{
    /** @test */
    public function it_loads_the_page_builder_instance()
    {
        $this->assertInstanceOf(Page::class, $this->app->make(AbstractPage::class));
        $this->assertInstanceOf(Page::class, $this->app->make(PageViewBuilder::class));
    }
}
