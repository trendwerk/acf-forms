<?php
namespace Trendwerk\AcfForms\Handler;

use Trendwerk\AcfForms\Entry\Entry;

final class Database implements HandlerInterface
{
    public function handle(array $form, Entry $entry)
    {
        $fieldGroups = $form['acfForm']['field_groups'];

        if ($fieldGroups) {
            $entry->setFieldGroups($fieldGroups);
        }

        $entry->setForm($form['name']);
    }
}
