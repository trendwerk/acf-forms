<?php
namespace Trendwerk\AcfForms\Notification;

use Trendwerk\AcfForms\Renderer\FieldGroup;

class Admin extends Notification
{
    protected function getBody()
    {
        $fieldGroups = $this->entry->getFieldGroups();
        $body = '';

        foreach ($fieldGroups as $fieldGroup) {
            $renderer = new FieldGroup($fieldGroup);
            $body .= $renderer->render($this->entry);
        }

        return $body;
    }

    protected function getRecipient()
    {
        return get_option('admin_email');
    }

    protected function getSubject()
    {
        return sprintf(__('Filled in form: %1$s', 'acf-forms'), $this->entry->getTitle());
    }
}
