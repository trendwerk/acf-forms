<?php
namespace Trendwerk\AcfForms\Form;

use Trendwerk\AcfForms\Entry\Entries;
use Trendwerk\AcfForms\Entry\Sanitizer;

final class Form
{
    private $name;
    private $options;

    public function __construct($name)
    {
        $forms = Forms::getInstance();
        $this->name = $name;
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
        $options = wp_parse_args($this->options['acfForm'], [
            'html_before_fields' => $this->getReferenceInput(),
            'new_post'           => [
                'post_status'    => 'publish',
                'post_type'      => Entries::POST_TYPE,
            ],
            'post_id'            => 'new_post',
        ]);

        acf_form($options);
    }

    private function getReferenceInput()
    {
        return '<input type="hidden" name="form" value="' . $this->name . '" />';
    }
}
