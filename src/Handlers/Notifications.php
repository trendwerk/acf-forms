<?php
namespace Trendwerk\AcfForms\Handlers;

use Trendwerk\AcfForms\Notifications\Admin;

final class Notifications implements HandlerInterface
{
    public function handle($entry)
    {
        $adminNotification = new Admin($entry);
        $adminNotification->send();
    }
}
