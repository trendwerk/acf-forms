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
                    'name' => 'Text',
                    'type' => 'text',
                ],
            ];
        }

        register_field_group([
            'key'    => $name,
            'fields' => $fields,
        ]);
    }

    protected function getFieldGroup($name)
    {
        if (! empty($GLOBALS['acf_register_field_group'])) {
            return array_reduce($GLOBALS['acf_register_field_group'], function ($carry, $item) use ($name) {
                if ($item['key'] == $name) {
                    return $item;
                }

                return $carry;
            });
        }
    }
}
