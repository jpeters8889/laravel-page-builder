<?php

namespace JPeters\PageViewBuilder\Tests;

use Illuminate\Support\Str;
use JPeters\PageViewBuilder\Page;

class MockPage extends Page
{
    public function __call($what, $arguments)
    {
        if (Str::startsWith($what, 'get')) {
            $what = Str::of($what)->replaceFirst('get', '')->camel();

            if (property_exists($this, $what)) {
                return $this->$what;
            }
        }

        if(method_exists($this, $what)) {
            return $this->$what(...$arguments);
        }

        return null;
    }
}
