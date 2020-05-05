<?php

namespace JPeters\PageViewBuilder;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class AbstractPage implements PageViewBuilder
{
    protected string $metaDescription = '';
    protected string $metaImage = '';
    protected array $metaKeywords = [];
    protected bool $displayFacebook = true;
    protected bool $displayTwitter = true;
    protected string $title = '';

    protected array $configuration = [];

    protected Request $request;
    protected ResponseFactory $response;

    public function __construct(Request $request, ResponseFactory $response)
    {
        $this->response = $response;
        $this->request = $request;

        $this->configuration = config('laravel-page-view');

        $this->setDefaults();
    }

    abstract protected function collectData(array $data): array;

    public function render(string $view, array $data = []): Response
    {
        return $this->response->view($view, $this->collectData($data));
    }

    protected function setDefaults(): void
    {
        $this->metaDescription = $this->configuration['metas']['description'];
        $this->metaImage = $this->configuration['social']['image'];
        $this->metaKeywords = $this->configuration['metas']['keywords'];
        $this->displayFacebook = $this->configuration['social']['facebook'];
        $this->displayTwitter = $this->configuration['social']['twitter'];
        $this->title = $this->configuration['title']['full'];
    }
}
