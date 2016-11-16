<?php
namespace Trendwerk\AcfForms;

final class Entries
{
    private $postType = 'entries';

    public function init()
    {
        add_action('init', [$this, 'registerPostType']);
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
}
