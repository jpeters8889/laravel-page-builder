<?php

namespace JPeters\PageViewBuilder;

use Illuminate\Http\Response;

interface PageViewBuilder
{
    public function hideFacebook(): AbstractPage;

    public function hideTwitter(): AbstractPage;

    public function render(string $view, array $data = []): Response;

    public function setMetaDescription($description): AbstractPage;

    public function setMetaKeywords(array $keywords): AbstractPage;

    public function setPageTitle($title): AbstractPage;

    public function setSocialImage($image): AbstractPage;

    public function showFacebook(): AbstractPage;

    public function showTwitter(): AbstractPage;

}
