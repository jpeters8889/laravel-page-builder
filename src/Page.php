<?php

namespace JPeters\PageViewBuilder;

class Page extends AbstractPage
{
    protected function collectData(array $data = []): array
    {
        $twitter = false;

        if($this->displayTwitter) {
            $twitter = (object)[
                'handle' => $this->configuration['social']['twitter-handle'],
            ];
        }

        return array_merge([
            'page' => (object)[
                'url' => $this->request->url(),
                'title' => $this->makeTitleForOutput(),
                'metas' => (object)[
                    'keywords' => implode(',', $this->metaKeywords),
                    'description' => $this->metaDescription,
                    'image' => $this->metaImage,
                ],
                'social' => (object)[
                    'facebook' => $this->displayFacebook,
                    'twitter' => $twitter,
                ]
            ],
        ], $data);
    }

    public function hideFacebook(): Page
    {
        $this->displayFacebook = false;

        return $this;
    }

    public function hideTwitter(): Page
    {
        $this->displayTwitter = false;

        return $this;
    }

    public function setMetaDescription($description): Page
    {
        $this->metaDescription = $description;

        return $this;
    }

    public function setMetaKeywords(array $keywords): Page
    {
        $this->metaKeywords = array_merge($this->metaKeywords, $keywords);

        return $this;
    }

    protected function makeTitleForOutput()
    {
        if ($this->title === $this->configuration['title']['full']) {
            return $this->title;
        }

        return $this->title . ' ' . $this->configuration['title']['separator'] . ' ' . $this->configuration['title']['short'];
    }

    public function setSocialImage($image): Page
    {
        $this->metaImage = $image;

        return $this;
    }

    public function setPageTitle($title): Page
    {
        $this->title = $title;

        return $this;
    }

    public function showFacebook(): Page
    {
        $this->displayFacebook = true;

        return $this;
    }

    public function showTwitter(): Page
    {
        $this->displayTwitter = true;

        return $this;
    }
}
