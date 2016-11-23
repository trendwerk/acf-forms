<?php
namespace Trendwerk\AcfForms\Renderers;

class Textarea extends Field implements RendererInterface
{
    protected function value($entry)
    {
        if ($this->field['new_lines'] === 'wpautop') {
            $value = $this->getValue($entry);

            return $value;
        }

        return parent::value($entry);
    }
}
