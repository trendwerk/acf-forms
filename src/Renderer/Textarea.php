<?php
namespace Trendwerk\AcfForms\Renderer;

use Trendwerk\AcfForms\Entry\Entry;

class Textarea extends Field implements RendererInterface
{
    protected function value(Entry $entry)
    {
        if ($this->field['new_lines'] === 'wpautop') {
            $value = $this->getValue($entry);

            return $value;
        }

        return parent::value($entry);
    }
}
