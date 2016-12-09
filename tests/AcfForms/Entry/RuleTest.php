<?php
namespace Trendwerk\AcfForms\Test;

use acf_admin_field_group;

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
        acf_include('admin/field-group.php');
        $acfFieldGroup = new acf_admin_field_group();

        ob_start();
        $acfFieldGroup->render_location_value([
            'param' => $this->rule,
        ]);
        $output = ob_get_clean();

        $this->assertContains('>' . __('Yes') . '<', $output);
        $this->assertContains('<option value="true"', $output);
    }

    public function testValuesHook()
    {
        $values = apply_filters('acf/location/rule_values/' . $this->rule, []);

        $this->assertArrayHasKey('true', $values);
        $this->assertEquals($values['true'], __('Yes'));
    }
}
