<?php

namespace JPeters\PageViewBuilder\Tests;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class PageViewSetValuesTest extends TestCase
{
    private MockPage $pageBuilder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pageBuilder = new MockPage($this->app->make(Request::class), $this->app->make(ResponseFactory::class));
    }

    /**
     * @test
     * @dataProvider settableDataSources
     * @param $setMethod
     * @param $value
     * @param $getMethod
     * @param null $expected
     */
    public function it_can_have_values_set($setMethod, $value, $getMethod, $expected = null)
    {
        $this->pageBuilder->$setMethod($value);

        $this->assertEquals($expected ?: $value, $this->pageBuilder->$getMethod());
    }

    /**
     * @test
     * @dataProvider booleanDataSources
     * @param $setMethod
     * @param $assertion
     * @param $getMethod
     */
    public function it_can_have_boolean_values_set($setMethod, $assertion, $getMethod)
    {
        $this->pageBuilder->$setMethod();

        $this->$assertion($this->pageBuilder->$getMethod());
    }

    public function settableDataSources(): array
    {
        // [setMethod, string, getMethod, expected]]
        return [
            ['setPageTitle', 'Foo', 'getTitle'],
            ['setMetaDescription', 'Test Description', 'getMetaDescription'],
            ['setMetaKeywords', ['foo', 'bar'], 'getMetaKeywords', ['page builder', 'foo', 'bar']],
            ['setSocialImage', 'foo.jpg', 'getMetaImage'],
        ];
    }

    public function booleanDataSources(): array
    {
        // [setMethod, assertion, getMethod]
        return [
            ['hideFacebook', 'assertFalse', 'getDisplayFacebook'],
            ['hideTwitter', 'assertFalse', 'getDisplayTwitter'],
            ['showFacebook', 'assertTrue', 'getDisplayFacebook'],
            ['showTwitter', 'assertTrue', 'getDisplayTwitter'],
        ];
    }
}
