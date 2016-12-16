<?php
namespace Trendwerk\AcfForms\Test\Entry;

use Trendwerk\AcfForms\Entry\Entries;
use Trendwerk\AcfForms\Test\TestCase;

class EntriesTest extends TestCase
{
    private $table;

    public function setUp()
    {
        parent::setUp();

        $editorId = $this->factory->user->create([
            'role' => 'editor',
        ]);

        wp_set_current_user($editorId);

        set_current_screen('edit-' . Entries::POST_TYPE);
        $GLOBALS['hook_suffix'] = '';
        $this->table = _get_list_table('WP_Posts_List_Table');
    }

    public function testPostType()
    {
        $this->assertTrue(post_type_exists(Entries::POST_TYPE));
    }

    public function testRemovedBulkEdit()
    {
        ob_start();
        $this->table->bulk_actions();
        $output = ob_get_clean();

        $this->assertNotContains('Edit', $output);
    }

    public function testRowActions()
    {
        $entry = $this->factory->post->create_and_get([
            'post_type' => Entries::POST_TYPE,
        ]);

        ob_start();
        $this->table->single_row($entry);
        $output = ob_get_clean();

        $this->assertContains('view', $output);
        $this->assertNotContains('<span class=\'edit\'>', $output);
        $this->assertNotContains('editinline', $output);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($GLOBALS['current_screen']);
    }
}
