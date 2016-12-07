<?php
namespace Trendwerk\AcfForms\Handler;

use Trendwerk\AcfForms\Entry\Entry;

final class Notifications implements HandlerInterface
{
    public function handle(array $form, Entry $entry)
    {
        if (isset($form['notifications'])) {
            $classNames = (array) $form['notifications'];
        } else {
            $classNames = ['Trendwerk\\AcfForms\\Notification\\Admin'];
        }
        
        foreach ($classNames as $className) {
            $notification = new $className($entry);
            $notification->send();
        }
    }
}
