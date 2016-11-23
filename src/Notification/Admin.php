<?php
namespace Trendwerk\AcfForms\Notification;

use Trendwerk\AcfForms\Renderer\FieldGroup;

final class Admin extends Notification
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
        $fieldGroups = $this->entry->getFieldGroups();
        $fieldGroupNames = array_map(function ($fieldGroup) {
            $fieldGroupObject = acf_get_field_group($fieldGroup);

            return $fieldGroupObject['title'];
        }, $fieldGroups);

        return sprintf(__('Filled in form: %1$s', 'acf-forms'), implode(', ', $fieldGroupNames));
    }

    public function send()
    {
        return wp_mail($this->getRecipient(), $this->getSubject(), $this->getBody(), $this->getHeaders());
    }
}
