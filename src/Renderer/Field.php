<?php
namespace Trendwerk\AcfForms\Renderer;

use Trendwerk\AcfForms\Entry\Entry;

class Field implements RendererInterface
{
    protected $field;

    public function __construct(array $field)
    {
        $this->field = $field;
    }

    public function render(Entry $entry, $label = true)
    {
        $output = '';

        if (! $this->getValue($entry)) {
            return;
        }

        if ($label) {
            $output .= $this->label();
        }

        $output .= $this->value($entry);

        return $output;
    }

    protected function getValue(Entry $entry)
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

    protected function value(Entry $entry)
    {
        $value = $this->getValue($entry);

        return "<p>{$value}</p>";
    }
}
