<?php
namespace Trendwerk\AcfForms\Entry;

use InvalidArgumentException;
use Trendwerk\AcfForms\Form\Forms;

final class Entry
{
    private $id;
    private $keys = [
        'fieldGroups' => '_fieldGroups',
        'form'        => '_form',
    ];

    private function __construct($id)
    {
        $this->id = $id;
    }

    public static function find($id)
    {
        return new static($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getField($field)
    {
        return get_field($field, $this->id);
    }

    public function getFieldGroups()
    {
        return array_filter((array) get_post_meta($this->id, $this->keys['fieldGroups'], true));
    }

    public function setFieldGroups(array $fieldGroups)
    {
        update_post_meta($this->id, $this->keys['fieldGroups'], $fieldGroups);
    }

    public function getForm()
    {
        return get_post_meta($this->id, $this->keys['form'], true);
    }

    public function setForm($form)
    {
        update_post_meta($this->id, $this->keys['form'], $form);
    }

    public function getTitle()
    {
        $forms = Forms::getInstance();
        $form = $this->getForm();
        
        try {
            $form = $forms->get($form);

            if (isset($form['label'])) {
                $name = $form['label'];
            } else {
                $name = $form['name'];
            }
        } catch (InvalidArgumentException $e) {
            $name = $form;
        }

        $date = get_the_date(null, $this->id);
        $time = get_the_time(null, $this->id);

        return sprintf(__('%1$s at %2$s on %3$s', 'acf-forms'), $name, $date, $time);
    }
}
