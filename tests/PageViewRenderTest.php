<?php

namespace JPeters\PageViewBuilder\Tests;

use JPeters\PageViewBuilder\PageViewBuilder;
use Spatie\Snapshots\MatchesSnapshots;

class PageViewRenderTest extends TestCase
{
    use MatchesSnapshots;

    protected PageViewBuilder $pageBuilder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pageBuilder = $this->app->make(PageViewBuilder::class);
    }

    /** @test */
    public function it_renders_the_view()
    {
        $content = $this->pageBuilder->render('test');

        $this->assertMatchesSnapshot($content->content());
    }

    /** @test */
    public function it_sends_data_to_the_view()
    {
        $list = ['foo', 'bar', 'baz'];

        $content = $this->pageBuilder->render('test-wth-data', [
            'list' => $list,
        ]);

        $this->assertMatchesSnapshot($content->content());

        foreach($list as $item) {
            $this->assertStringContainsString("<li>{$item}</li>", $content->content());
        }
    }
}
