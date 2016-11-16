<?php
namespace Trendwerk\AcfForms;

final class Entry
{
    private $id;
    private $keys = [
        'fieldGroups' => '_fieldGroups',
    ];

    private function __construct($id)
    {
        $this->id = $id;
    }

    public static function find($id)
    {
        return new static($id);
    }

    public function getFieldGroups()
    {
        return (array) get_post_meta($this->id, $this->keys['fieldGroups'], true);
    }

    public function setFieldGroups($fieldGroups)
    {
        update_post_meta($this->id, $this->keys['fieldGroups'], $fieldGroups);
    }
}
