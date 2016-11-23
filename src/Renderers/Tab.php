<?php
namespace Trendwerk\AcfForms\Renderers;

class Tab extends Field implements RendererInterface
{
    public function render($entry)
    {
        return "<hr><h2>{$this->field['label']}</h2>";
    }
}
