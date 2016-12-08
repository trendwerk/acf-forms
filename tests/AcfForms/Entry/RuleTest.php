<?php
namespace Trendwerk\AcfForms\Test;

class RuleTest extends \WP_UnitTestCase
{
    private $rule = 'acf-form';

    public function testAddHook()
    {
        $types = apply_filters('acf/location/rule_types', []);

        $this->assertArrayHasKey(__('Forms', 'acf'), $types);
        $this->assertArrayHasKey($this->rule, $types[__('Forms', 'acf')]);
        $this->assertEquals(__('Front-end', 'acf-forms'), $types[__('Forms', 'acf')][$this->rule]);
    }

    public function testValuesOutput()
    {
        ob_start();
        do_action('wp_ajax_acf/field_group/render_location', [
            'param' => $this->rule,
        ]);
        $output = ob_get_clean();

        $this->assertContains(__('Yes'), $output);
        $this->assertContains('<option value="true"', $output);
    }
}
