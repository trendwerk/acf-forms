<?php
namespace Trendwerk\AcfForms\Renderers;

class Field implements RendererInterface
{
    private $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public function render($entry)
    {
        $value = $entry->getField($this->field['key']);

        return "<p><strong>{$this->field['label']}</strong><br />{$value}</p>";
    }
}
