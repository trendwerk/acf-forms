<?php
namespace Trendwerk\AcfForms\Notification;

use Trendwerk\AcfForms\Entry\Entry;

abstract class Notification
{
    protected $entry;

    abstract protected function getBody();
    abstract protected function getRecipient();
    abstract protected function getSubject();

    public function __construct(Entry $entry)
    {
        $this->entry = $entry;
    }

    public function send()
    {
        return wp_mail(
            $this->getRecipient(),
            $this->getSubject(),
            $this->getBody(),
            $this->getHeaders(),
            $this->getAttachments()
        );
    }

    protected function getAttachments()
    {
        return [];
    }

    protected function getHeaders()
    {
        return [
            'Content-Type: text/html',
        ];
    }
}
