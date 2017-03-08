<?php
namespace Trendwerk\AcfForms\Renderer;

use Trendwerk\AcfForms\Entry\Entry;

final class FieldGroup implements RendererInterface
{
    private $fieldGroup;

    public function __construct($fieldGroup)
    {
        $this->fieldGroup = $fieldGroup;
    }

    public function render(Entry $entry, $label = true)
    {
        $fields = acf_get_fields($this->fieldGroup);

        if (! is_array($fields)) {
            return;
        }

        $output = '';

        foreach ($fields as $field) {
            $field = FieldFactory::create($field);
            $output .= $field->render($entry);
        }

        return $output;
    }
}
