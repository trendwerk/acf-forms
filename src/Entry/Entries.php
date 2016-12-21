<?php
namespace Trendwerk\AcfForms\Entry;

use WP_Post;

final class Entries
{
    const POST_TYPE = 'entries';

    /**
     * @codeCoverageIgnore
     */
    public function init()
    {
        add_action('init', [$this, 'registerPostType']);
        add_filter('bulk_actions-edit-' . self::POST_TYPE, [$this, 'removeBulkEdit']);
        add_filter('post_row_actions', [$this, 'setRowActions'], 10, 2);
        add_action('add_meta_boxes_' . self::POST_TYPE, [$this, 'removePublish']);
    }

    /**
     * @codeCoverageIgnore
     */
    public function registerPostType()
    {
        register_post_type(self::POST_TYPE, [
            'capabilities'     => [
                'create_posts' => 'do_not_allow',
            ],
            'labels'           => [
                'name'         => __('Entries', 'acf-forms'),
                'edit_item'    => __('View entry', 'acf-forms'),
            ],
            'map_meta_cap'     => true,
            'menu_icon'        => 'dashicons-clipboard',
            'show_ui'          => true,
            'supports'         => array('title'),
        ]);
    }

    public function removeBulkEdit(array $actions)
    {
        unset($actions['edit']);

        return $actions;
    }

    public function setRowActions(array $actions, WP_Post $post)
    {
        if (get_post_type($post->ID) !== self::POST_TYPE) {
            return $actions;
        }

        unset($actions['edit']);
        unset($actions['inline hide-if-no-js']);

        $newActions = [
            'view' => '<a href="' . get_edit_post_link($post->ID) . '">' . __('View') . '</a>',
        ];

        return array_merge($newActions, $actions);
    }

    public function removePublish()
    {
        remove_meta_box('submitdiv', self::POST_TYPE, 'side');
    }
}
