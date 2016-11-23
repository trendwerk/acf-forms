<?php
namespace Trendwerk\AcfForms\Renderers;

class Repeater extends Field implements RendererInterface
{
    public function render($entry, $label = true)
    {
        $rows = $this->getValue($entry);

        if (count($rows) == 0) {
            return;
        }

        if ($label) {
            $output = $this->label();
        }

        $output .= $this->start();

        foreach ($rows as $row) {
            $output .= $this->row($row, $entry);
        }

        $output .= $this->end();

        return $output;
    }

    protected function start()
    {
        return '<table style="width: 100%;">' . $this->getTableHead();
    }

    protected function end()
    {
        return '</table>';
    }

    protected function rowStart()
    {
        return '<tr>';
    }

    protected function row($row, $entry)
    {
        $output = $this->rowStart();

        foreach ($this->field['sub_fields'] as $subField) {
            $subField['value'] = $row[$subField['name']];

            $subField = FieldFactory::create($subField);
            $output .= "<td>{$subField->render($entry, false)}</td>";
        }

        $output .= $this->rowEnd();

        return $output;
    }

    protected function rowEnd()
    {
        return '</tr>';
    }

    protected function getTableHead()
    {
        $output = '<thead><tr>';

        foreach ($this->field['sub_fields'] as $subField) {
            $output .= "<th style=\"text-align: left;\">{$subField['label']}</th>";
        }

        $output .= '</tr></thead>';

        return $output;
    }
}
