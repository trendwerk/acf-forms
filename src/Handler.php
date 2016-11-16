<?php
namespace Trendwerk\AcfForms;

final class Handler
{
    private $entries;

    public function __construct($entries)
    {
        $this->entries = $entries;
    }

    public function init()
    {
        add_action('acf/save_post', [$this, 'saveFieldGroups']);
    }

    public function saveFieldGroups($postId)
    {
        if (get_post_type($postId) != $this->entries->getPostType()) {
            return;
        }

        if (! isset($_POST['fieldGroups'])) {
            return;
        }

        $fieldGroups = array_map('esc_attr', json_decode(stripslashes($_POST['fieldGroups'])));

        if ($fieldGroups) {
            update_post_meta($postId, 'fieldGroups', $fieldGroups);
        }
    }
}
