<?php
namespace Trendwerk\AcfForms\Renderers;

final class FieldGroup implements RendererInterface
{
    private $fieldGroup;

    public function __construct($fieldGroup)
    {
        $this->fieldGroup = $fieldGroup;
    }

    public function render($entry, $label = true)
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
