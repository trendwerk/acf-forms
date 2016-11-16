<?php
namespace Trendwerk\AcfForms;

final class Plugin
{
    public function init()
    {
        $entries = new Entries();
        $entries->init();

        $handler = new Handler($entries);
        $handler->init();
    }
}
