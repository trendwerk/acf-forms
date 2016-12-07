<?php
namespace Trendwerk\AcfForms\Notification;

abstract class Notification
{
    protected $entry;

    abstract protected function getBody();
    abstract protected function getRecipient();
    abstract protected function getSubject();

    public function __construct($entry)
    {
        $this->entry = $entry;
    }

    public function send()
    {
        return wp_mail($this->getRecipient(), $this->getSubject(), $this->getBody(), $this->getHeaders());
    }

    protected function getHeaders()
    {
        return [
            'Content-Type: text/html',
        ];
    }
}
