<?php
namespace Trendwerk\AcfForms\Test\Entry;

use Trendwerk\AcfForms\Entry\Sanitizer;
use Trendwerk\AcfForms\Test\TestCase;

class SanitizerTest extends TestCase
{
    public function testSanitize()
    {
        $xssValue = ['\'\';!--"<XSS>=&{()}'];
        $xssTest = '<XSS';
        $entry = $this->createEntry();
        $field = 'testField';

        // without sanitizer
        update_field($field, $xssValue, $entry->getId());

        $values = $entry->getField($field);

        foreach ($values as $value) {
            $this->assertContains($xssTest, $value);
        }

        // with sanitizer
        $sanitizer = new Sanitizer();
        $sanitizer->init();

        update_field($field, $xssValue, $entry->getId());

        $values = $entry->getField($field);

        foreach ($values as $value) {
            $this->assertNotContains($xssTest, $value);
        }
    }
}
