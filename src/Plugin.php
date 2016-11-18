<?php
namespace Trendwerk\AcfForms;

final class Plugin
{
    public function init()
    {
        $entries = new Entries();
        $entries->init();

        $handler = new Handler();
        $handler->init();

        $rule = new Rule();
        $rule->init();
    }
}
