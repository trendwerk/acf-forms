<?php
namespace Trendwerk\AcfForms\Test;

class EntriesTest extends \WP_UnitTestCase
{
    public function testPostType()
    {
        $this->assertTrue(post_type_exists('entries'));
    }
}
