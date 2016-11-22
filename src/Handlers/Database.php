<?php
namespace Trendwerk\AcfForms\Handlers;

final class Database implements HandlerInterface
{
    public function handle($entry)
    {
        if (! isset($_POST['fieldGroups'])) {
            return;
        }

        $fieldGroups = array_map('esc_attr', json_decode(stripslashes($_POST['fieldGroups'])));

        if ($fieldGroups) {
            $entry->setFieldGroups($fieldGroups);
        }
    }
}
