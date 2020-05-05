<?php

namespace JPeters\PageViewBuilder\Tests;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class PageViewDefaultsTest extends TestCase
{
    private MockPage $pageBuilder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pageBuilder = new MockPage($this->app->make(Request::class), $this->app->make(ResponseFactory::class));
    }

    /**
     * @test
     * @dataProvider dataSources
     */
    public function it_respects_the_defaults_from_the_configuration($method, $value)
    {
        $this->assertEquals($value, $this->pageBuilder->$method());
    }

    public function dataSources()
    {
        // [getMethod, value]
        return [
            ['getTitle', 'Laravel Page Builder - Easily Craft Your Views!'],
            ['getMetaDescription', 'Laravel Page Builder - Build your views and meta information easily'],
            ['getMetaKeywords', ['page builder']],
            ['getMetaImage', 'page-builder.jpg'],
        ];
    }
}
