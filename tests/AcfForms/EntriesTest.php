<?php
namespace Trendwerk\AcfForms\Test;

use Trendwerk\AcfForms\Entries;

class EntriesTest extends \WP_UnitTestCase
{
    public function testPostType()
    {
        $this->assertTrue(post_type_exists(Entries::POST_TYPE));
    }
}
