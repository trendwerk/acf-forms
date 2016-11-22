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
            
            default:
                return new Field($field);
                break;
        }
    }
}
