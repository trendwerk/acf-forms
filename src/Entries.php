<?php
namespace Trendwerk\AcfForms;

final class Entries
{
    private $postType = 'entries';

    public function init()
    {
        add_action('init', [$this, 'registerPostType']);
        add_filter('bulk_actions-edit-' . $this->postType, [$this, 'removeBulkEdit']);
        add_filter('post_row_actions', [$this, 'setRowActions']);
    }

    public function registerPostType()
    {
        register_post_type($this->postType, [
            'capabilities'     => [
                'create_posts' => 'do_not_allow',
            ],
            'labels'           => [
                'name'         => __('Entries', 'acf-forms'),
                'edit_item'    => __('View entry', 'acf-forms'),
            ],
            'menu_icon'        => 'dashicons-clipboard',
            'show_ui'          => true,
            'supports'         => array('title'),
        ]);
    }

    public function removeBulkEdit($actions)
    {
        unset($actions['edit']);

        return $actions;
    }

    public function setRowActions($actions, $post)
    {
        if (get_post_type($post->ID) !== $this->postType) {
            return $actions;
        }

        unset($actions['edit']);
        unset($actions['inline hide-if-no-js']);

        $newActions = [
            'view' => '<a href="' . get_edit_post_link($post->ID) . '">' . __('View') . '</a>',
        ];

        return array_merge($newActions, $actions);
    }
}
