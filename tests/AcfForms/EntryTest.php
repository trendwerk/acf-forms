<?php
namespace Trendwerk\AcfForms\Test;

use Trendwerk\AcfForms\Entries;
use Trendwerk\AcfForms\Entry;

class EntryTest extends \WP_UnitTestCase
{
    private $postId;

    public function setUp()
    {
        parent::setUp();

        $this->postId = $this->factory->post->create([
            'post_type' => Entries::POST_TYPE,
        ]);
    }

    public function testFind()
    {
        $entry = Entry::find($this->postId);
        $this->assertEquals('Trendwerk\AcfForms\Entry', get_class($entry));
        $this->assertEquals($this->postId, $entry->id);
    }

    public function testEmptyFieldGroup()
    {
        $entry = Entry::find($this->postId);
        $this->assertEquals([], $entry->getFieldGroups());
    }
}
