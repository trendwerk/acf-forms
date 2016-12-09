<?php
namespace Trendwerk\AcfForms\Test;

use Trendwerk\AcfForms\Entry\Entries;
use Trendwerk\AcfForms\Entry\Entry;

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

    protected function createEntry()
    {
        $postId = $this->factory->post->create([
            'post_type' => Entries::POST_TYPE,
        ]);

        return Entry::find($postId);
    }
}
