<?php
namespace Trendwerk\AcfForms\Renderer;

use Trendwerk\AcfForms\Entry\Entry;

class PostObject extends Field implements RendererInterface
{
    protected function getValue(Entry $entry)
    {
        $value = parent::getValue($entry);

        if ($this->field['return_format'] == 'id') {
            return get_the_title($value);
        } else {
            return get_the_title($value->ID);
        }
    }
}
