<?php
namespace Trendwerk\AcfForms\Handler;

final class Database implements HandlerInterface
{
    public function handle($form, $entry)
    {
        $fieldGroups = $form['acfForm']['field_groups'];

        if ($fieldGroups) {
            $entry->setFieldGroups($fieldGroups);
        }
    }
}
