<?php
namespace Trendwerk\AcfForms;

final class Plugin
{
    public function init()
    {
        $entries = new Entries();
        $entries->init();

        $handler = new Handlers\Handlers([
            new Handlers\Database(),
            new Handlers\Notifications(),
        ]);
        $handler->init();

        $rule = new Rule();
        $rule->init();
    }

    public function register($name, $options = [])
    {
        $forms = Forms::getInstance();
        $forms->add($name, $options);
    }
}
