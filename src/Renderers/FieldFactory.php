<?php
namespace Trendwerk\AcfForms\Renderers;

final class FieldFactory
{
    public static function create($field)
    {
        return new Field($field);
    }
}
