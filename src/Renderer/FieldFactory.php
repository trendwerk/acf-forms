<?php
namespace Trendwerk\AcfForms\Renderer;

final class FieldFactory
{
    public static function create(array $field)
    {
        switch ($field['type']) {
            case 'post_object':
                return new PostObject($field);
                break;
            case 'repeater':
                return new Repeater($field);
                break;
            case 'tab':
                return new Tab($field);
                break;
            case 'textarea':
                return new Textarea($field);
                break;
            default:
                return new Field($field);
                break;
        }
    }
}
