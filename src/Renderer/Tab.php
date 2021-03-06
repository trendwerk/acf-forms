<?php
namespace Trendwerk\AcfForms\Renderer;

use Trendwerk\AcfForms\Entry\Entry;

class Tab extends Field implements RendererInterface
{
    protected static $first = true;

    public function render(Entry $entry, $label = true)
    {
        if (! $label) {
            return;
        }

        $output = '';

        if ($this->shouldRenderDivider()) {
            $output .= $this->divider();
        }

        self::$first = false;

        $output .= "<h2>{$this->field['label']}</h2>";

        return $output;
    }

    protected function divider()
    {
        return '<hr>';
    }

    private function shouldRenderDivider()
    {
        return ! self::$first;
    }
}
