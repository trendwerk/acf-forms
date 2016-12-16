<?php
namespace Trendwerk\AcfForms\Test\Entry;

use Trendwerk\AcfForms\Entry\Sanitizer;
use Trendwerk\AcfForms\Test\TestCase;

class SanitizerTest extends TestCase
{
    public function testSanitize()
    {
        $xssValue = '\'\';!--"<XSS>=&{()}';
        $xssTest = '<XSS';
        $entry = $this->createEntry();
        $field = 'testField';

        // without sanitizer
        update_field($field, $xssValue, $entry->getId());
        $this->assertContains($xssTest, $entry->getField($field));

        // with sanitizer
        $sanitizer = new Sanitizer();
        $sanitizer->init();

        update_field($field, $xssValue, $entry->getId());
        $this->assertNotContains($xssTest, $entry->getField($field));
    }
}
