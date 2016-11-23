<?php
namespace Trendwerk\AcfForms\Renderer;

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
