<?php
namespace Trendwerk\AcfForms\Renderer;

use Trendwerk\AcfForms\Entry\Entry;

interface RendererInterface
{
    public function render(Entry $entry, $label = true);
}
