<?php
namespace Trendwerk\AcfForms\Notifications;

abstract class Notification
{
    protected $entry;

    abstract protected function getBody();
    abstract protected function getRecipient();
    abstract protected function getSubject();
    abstract public function send();

    public function __construct($entry)
    {
        $this->entry = $entry;
    }

    protected function getHeaders()
    {
        return [
            'Content-Type: text/html',
        ];
    }
}
