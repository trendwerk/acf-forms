<?php
namespace Trendwerk\AcfForms\Handler;

use Trendwerk\AcfForms\Notification\Admin;

final class Notifications implements HandlerInterface
{
    public function handle($form, $entry)
    {
        $adminNotification = new Admin($entry);
        $adminNotification->send();
    }
}
