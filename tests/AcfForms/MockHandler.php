<?php
namespace Trendwerk\AcfForms\Test;

use Trendwerk\AcfForms\Entry\Entry;
use Trendwerk\AcfForms\Handler\HandlerInterface;

final class MockHandler implements HandlerInterface
{
    public $success = false;

    public function handle(array $form, Entry $entry)
    {
        if ($form && $entry) {
            $this->success = true;
        }
    }
}
