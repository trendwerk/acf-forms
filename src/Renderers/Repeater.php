<?php
namespace Trendwerk\AcfForms\Renderers;

class Repeater extends Field implements RendererInterface
{
    public function render($entry)
    {
        $rows = $this->getValue($entry);

        if (count($rows) == 0) {
            return;
        }

        $output .= $this->start();

        foreach ($rows as $row) {
            $output .= $this->row($row);
        }

        $output .= $this->end();

        return $output;
    }

    protected function start()
    {
        return '<table>' . $this->getTableHead();
    }

    protected function end()
    {
        return '</table>';
    }

    protected function rowStart()
    {
        return '<tr>';
    }

    protected function row($row, $fields)
    {
        $output = $this->rowStart();

        foreach ($this->field['sub_fields'] as $subField) {
            $subField['value'] = $row[$subField['name']];

            $subField = FieldFactory::create($subField);
            $output .= "<td>{$subField->render($entry)}</td>";
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
        $output = '<thead><tr></tr></thead>';

        return $output;
    }
}
