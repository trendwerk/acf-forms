<?php
namespace Trendwerk\AcfForms;

final class Handler
{
    public function init()
    {
        add_action('acf/save_post', [$this, 'saveFieldGroups']);
    }

    public function saveFieldGroups($postId)
    {
        if (get_post_type($postId) != Entries::POST_TYPE) {
            return;
        }

        if (! isset($_POST['fieldGroups'])) {
            return;
        }

        $fieldGroups = array_map('esc_attr', json_decode(stripslashes($_POST['fieldGroups'])));

        if ($fieldGroups) {
            $entry = Entry::find($postId);
            $entry->setFieldGroups($fieldGroups);
        }
    }
}
