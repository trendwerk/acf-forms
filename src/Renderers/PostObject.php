<?php
namespace Trendwerk\AcfForms\Renderers;

class PostObject extends Field implements RendererInterface
{
    protected function getValue($entry)
    {
        $value = parent::getValue($entry);

        if ($this->field['return_format'] == 'id') {
            return get_the_title($value);
        } else {
            return get_the_title($value->ID);
        }
    }
}
