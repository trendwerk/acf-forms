<?php
namespace Trendwerk\AcfForms;

final class Plugin
{
    public function init()
    {
        $this->initEntries();
    }

    private function initEntries()
    {
        $entries = new Entries();
        $entries->init();
    }
}
