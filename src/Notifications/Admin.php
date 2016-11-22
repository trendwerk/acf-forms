<?php
namespace Trendwerk\AcfForms\Notifications;

final class Admin extends Notification
{
    protected function getBody()
    {
        return '';
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
