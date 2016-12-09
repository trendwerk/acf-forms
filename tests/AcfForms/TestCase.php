<?php
namespace Trendwerk\AcfForms\Test;

abstract class TestCase extends \WP_UnitTestCase
{
    protected function createFieldGroup($name, $fields = [])
    {
        if (count($fields) == 0) {
            $fields = [
                [
                    'key'  => 'field_' . uniqid(),
                    'name' => 'text',
                    'type' => 'text',
                ],
            ];
        }

        acf_add_local_field_group([
            'key'    => $name,
            'fields' => $fields,
        ]);
    }

    protected function getFieldGroup($name)
    {
        return acf_get_local_field_group($name);
    }
}
