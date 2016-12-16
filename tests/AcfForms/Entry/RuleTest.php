<?php
namespace Trendwerk\AcfForms\Test\Entry;

use acf_admin_field_group;
use Trendwerk\AcfForms\Test\TestCase;

class RuleTest extends TestCase
{
    private $rule = 'acf-form';

    public function testAddOutput()
    {
        acf_include('admin/field-group.php');
        $acfFieldGroup = new acf_admin_field_group();

        ob_start();
        $acfFieldGroup->mb_locations();
        $output = ob_get_clean();

        $this->assertContains('<option value="' . $this->rule . '">Front-end</option>', $output);
    }

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

    public function testMatch()
    {
        $fieldGroupName = 'testFieldGroup';

        $this->createFieldGroup($fieldGroupName, null, [
            [
                [
                    'param'    => $this->rule,
                    'operator' => '==',
                    'value'    => 'true',
                ],
            ],
        ]);

        $entry = $this->createEntry([$fieldGroupName]);

        $visibility = acf_get_field_group_visibility($this->getFieldGroup($fieldGroupName), [
            'post_id' => $entry->getId(),
        ]);

        $this->assertTrue($visibility);

        $this->destroyFieldGroup($fieldGroupName);
    }

    public function testDontMatch()
    {
        $fieldGroupName = 'testFieldGroup';

        $this->createFieldGroup($fieldGroupName, null, [
            [
                [
                    'param'    => $this->rule,
                    'operator' => '==',
                    'value'    => 'true',
                ],
            ],
        ]);

        $entry = $this->createEntry();

        $visibility = acf_get_field_group_visibility($this->getFieldGroup($fieldGroupName), [
            'post_id' => $entry->getId(),
        ]);

        $this->assertFalse($visibility);

        $this->destroyFieldGroup($fieldGroupName);
    }
}
