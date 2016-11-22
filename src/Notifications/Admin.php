<?php
namespace Trendwerk\AcfForms\Notifications;

final class Admin extends Notification
{
    protected function getBody()
    {
        $fieldGroups = $this->entry->getFieldGroups();
        $fields = [];

        foreach ($fieldGroups as $fieldGroup) {
            $fieldGroupFields = acf_get_fields($fieldGroup);

            if (is_array($fieldGroupFields)) {
                $fields = array_merge($fieldGroupFields, $fields);
            }
        }

        $body = '';

        foreach ($fields as $field) {
            $value = $this->entry->getField($field['key']);

            if (is_array($value)) {
                $value = print_r($value, true);
            }

            $body .= '<p>';
            $body .= '<strong>' . $field['label'] . '</strong><br />';
            $body .= $value;
            $body .= '</p>';
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
