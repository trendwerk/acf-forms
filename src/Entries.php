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
            'menu_icon' => 'dashicons-clipboard',
            'show_ui'   => true,
            'supports'  => array('title'),
        ]);
    }
}
