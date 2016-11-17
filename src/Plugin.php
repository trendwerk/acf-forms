<?php
namespace Trendwerk\AcfForms;

final class Plugin
{
    private static $instance;

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    protected function __construct()
    {
    }

    public function init()
    {
        $entries = new Entries();
        $entries->init();

        $handler = new Handler($entries);
        $handler->init();

        $rule = new Rule();
        $rule->init();
    }
}
