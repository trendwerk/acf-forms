<?php
namespace Trendwerk\AcfForms\Renderers;

class PostObject extends Field implements RendererInterface
{
    protected function getValue($entry)
    {
        $value = parent::getValue($entry);

        return $value->post_title;
    }
}
