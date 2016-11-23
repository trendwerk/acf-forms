<?php
namespace Trendwerk\AcfForms\Entry;

final class Sanitizer
{
    public function init()
    {
        add_filter('acf/update_value', [$this, 'sanitize']);
    }

    public function sanitize($value)
    {
        if (is_array($value)) {
            return array_map([$this, 'sanitize'], $value);
        }

        return wp_kses_post($value);
    }
}
