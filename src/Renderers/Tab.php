<?php
namespace Trendwerk\AcfForms\Renderers;

class Tab extends Field implements RendererInterface
{
    protected static $first = true;

    public function render($entry)
    {
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
