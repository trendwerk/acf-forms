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
}
