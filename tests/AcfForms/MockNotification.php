<?php
namespace Trendwerk\AcfForms\Test;

use Trendwerk\AcfForms\Entry\Entry;
use Trendwerk\AcfForms\Notification\Admin;

final class MockNotification extends Admin
{
    public function send()
    {
        $GLOBALS['mockNotificationSuccess'] = true;
    }
}
