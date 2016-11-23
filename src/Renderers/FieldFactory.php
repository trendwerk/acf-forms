<?php
namespace Trendwerk\AcfForms\Renderers;

final class FieldFactory
{
    public static function create($field)
    {
        switch ($field['type']) {
            case 'repeater':
                return new Repeater($field);
                break;
            case 'post_object':
                return new PostObject($field);
                break;
            case 'tab':
                return new Tab($field);
                break;
            default:
                return new Field($field);
                break;
        }
    }
}
