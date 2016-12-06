<?php
namespace Trendwerk\AcfForms\Form;

use Trendwerk\AcfForms\Entry\Entries;
use Trendwerk\AcfForms\Entry\Sanitizer;

final class Form
{
    private $options;

    public function __construct($name)
    {
        $forms = Forms::getInstance();
        $this->options = $forms->get($name);
    }

    public static function head()
    {
        $sanitizer = new Sanitizer();
        $sanitizer->init();

        acf_form_head();
    }

    public function render()
    {
        if (! isset($this->options['acfForm']['field_groups'])) {
            return;
        }

        $options = wp_parse_args($this->options['acfForm'], [
            'html_before_fields' => $this->getFieldGroupsInput(),
            'new_post'           => [
                'post_status'    => 'publish',
                'post_type'      => Entries::POST_TYPE,
            ],
            'post_id'            => 'new_post',
        ]);

        acf_form($options);
    }

    private function getFieldGroupsInput()
    {
        $fieldGroups = esc_attr(json_encode($this->options['field_groups']));

        return '<input type="hidden" name="fieldGroups" value="' . $fieldGroups . '" />';
    }
}
