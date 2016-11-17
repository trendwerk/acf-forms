<?php
namespace Trendwerk\AcfForms;

final class Form
{
    private $options;

    public function __construct($options = [])
    {
        $this->options = $options;
    }

    public function render()
    {
        if (! isset($this->options['field_groups'])) {
            return;
        }

        $options = wp_parse_args($this->options, [
            'html_before_fields' => $this->getFieldGroupsInput(),
            'new_post'           => [
                'post_status'    => 'publish',
                'post_type'      => 'entries',
            ],
            'post_id'            => 'new_post',
        ]);

        acf_form($options);
    }

    private function getFieldGroupsInput()
    {
        return '<input type="hidden" name="fieldGroups" value="' . esc_attr(json_encode($this->options['field_groups'])) . '" />';
    }
}
