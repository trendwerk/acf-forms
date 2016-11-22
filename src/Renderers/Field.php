<?php
namespace Trendwerk\AcfForms\Renderers;

class Field implements RendererInterface
{
    protected $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public function render($entry)
    {
        $value = $this->getValue($entry);

        return "<p><strong>{$this->field['label']}</strong><br />{$value}</p>";
    }

    protected function getValue($entry)
    {
        if ($this->field['value']) {
            return $this->field['value'];
        } else {
            return $entry->getField($this->field['key']);
        }
    }
}
