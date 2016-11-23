<?php
namespace Trendwerk\AcfForms\Entry;

final class Rule
{
    private $rule = 'acf-form';

    public function init()
    {
        add_filter('acf/location/rule_types', [$this, 'add']);
        add_filter('acf/location/rule_values/' . $this->rule, [$this, 'values']);
        add_filter('acf/location/screen', [$this, 'addFieldGroup'], 10, 2);
        add_filter('acf/location/rule_match/' . $this->rule, [$this, 'match'], 10, 3);
    }

    public function add($rules)
    {
        $rules[__('Forms', 'acf')][$this->rule] = __('Front-end', 'acf-forms');

        return $rules;
    }

    public function values($values)
    {
        $values['true'] = __('Yes');

        return $values;
    }

    public function addFieldGroup($options, $fieldGroup)
    {
        $options['fieldGroup'] = $fieldGroup;

        return $options;
    }

    public function match($match, $rule, $args)
    {
        $entry = Entry::find($args['post_id']);
        $match = in_array($args['fieldGroup']['key'], $entry->getFieldGroups());

        if ($rule['operator'] === '!=') {
            return ! $match;
        }

        return $match;
    }
}
