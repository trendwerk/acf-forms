<?php
namespace Trendwerk\AcfForms\Renderers;

class Repeater extends Field implements RendererInterface
{
    public function render($entry)
    {
        $subFields = $this->field['sub_fields'];

        if (! is_array($subFields)) {
            return;
        }

        $output = '';
        $rows = $this->getValue($entry);

        foreach ($rows as $row) {
            foreach ($subFields as $subField) {
                $subField['value'] = $row[$subField['name']];

                $subField = FieldFactory::create($subField);
                $output .= $subField->render($entry);
            }
        }

        return $output;
    }
}
