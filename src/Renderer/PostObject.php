<?php
namespace Trendwerk\AcfForms\Renderer;

use Trendwerk\AcfForms\Entry\Entry;

class PostObject extends Field implements RendererInterface
{
    protected function getValue(Entry $entry)
    {
        $value = parent::getValue($entry);

        return get_the_title($value);
    }
}
