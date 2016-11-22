<?php
namespace Trendwerk\AcfForms\Test;

use Trendwerk\AcfForms\Entries;

class EntriesTest extends \WP_UnitTestCase
{
    public function setUp()
    {
        parent::setUp();

        $editorId = $this->factory->user->create([
            'role' => 'editor',
        ]);

        wp_set_current_user($editorId);
    }

    public function testPostType()
    {
        $this->assertTrue(post_type_exists(Entries::POST_TYPE));
    }

    public function testRemovedBulkEdit()
    {
        set_current_screen('edit-' . Entries::POST_TYPE);
        $GLOBALS['hook_suffix'] = '';
        $table = _get_list_table('WP_Posts_List_Table');

        ob_start();
        $table->bulk_actions();
        $output = ob_get_clean();

        $this->assertNotContains('Edit', $output);
    }
}
