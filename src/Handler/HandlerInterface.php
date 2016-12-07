<?php
namespace Trendwerk\AcfForms\Handler;

use Trendwerk\AcfForms\Entry\Entry;

interface HandlerInterface
{
    public function handle(array $form, Entry $entry);
}
