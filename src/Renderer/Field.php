<?php
namespace Trendwerk\AcfForms\Renderer;

class Field implements RendererInterface
{
    protected $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public function render($entry, $label = true)
    {
        $output = '';

        if ($label) {
            $output .= $this->label();
        }

        $output .= $this->value($entry);

        return $output;
    }

    protected function getValue($entry)
    {
        if ($this->field['value']) {
            return $this->field['value'];
        } else {
            return $entry->getField($this->field['key']);
        }
    }

    protected function label()
    {
        return "<h3>{$this->field['label']}</h3>";
    }

    protected function value($entry)
    {
        $value = $this->getValue($entry);

        return "<p>{$value}</p>";
    }
}
