<?php
namespace Trendwerk\AcfForms\Entry;

final class Rule
{
    private $rule = 'acf-form';

    /**
     * @codeCoverageIgnore
     */
    public function init()
    {
        add_filter('acf/location/rule_types', [$this, 'add']);
        add_filter('acf/location/rule_values/' . $this->rule, [$this, 'values']);
        add_filter('acf/location/rule_match/' . $this->rule, [$this, 'match'], 10, 4);
    }

    public function add(array $rules)
    {
        $rules[__('Forms', 'acf')][$this->rule] = __('Front-end', 'acf-forms');

        return $rules;
    }

    public function values(array $values)
    {
        $values['true'] = __('Yes');

        return $values;
    }

    public function match($match, array $rule, array $args, array $fieldGroup)
    {
        $entry = Entry::find($args['post_id']);
        $match = in_array($fieldGroup['key'], $entry->getFieldGroups());

        if ($rule['operator'] === '!=') {
            return ! $match;
        }

        return $match;
    }
}
