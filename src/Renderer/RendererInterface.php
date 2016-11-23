<?php
namespace Trendwerk\AcfForms\Renderer;

interface RendererInterface
{
    public function render($entry, $label = true);
}
