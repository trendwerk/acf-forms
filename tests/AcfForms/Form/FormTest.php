<?php
namespace Trendwerk\AcfForms\Test;

use Trendwerk\AcfForms\Form\Form;
use Trendwerk\AcfForms\Form\Forms;

class FormTest extends TestCase
{
    private $form = 'testForm';
    private $fieldGroup = 'testFieldGroup';

    public function setUp()
    {
        $this->createFieldGroup($this->fieldGroup);

        $this->forms = Forms::getInstance();
        $this->forms->add($this->form, [
            'acfForm'          => [
                'field_groups' => [$this->fieldGroup],
            ],
        ]);
    }

    public function testFieldGroup()
    {
        $this->assertNotNull($this->getFieldGroup($this->fieldGroup));
    }

    public function testHead()
    {
        ob_start();
        Form::head();
        wp_print_scripts();
        $output = ob_get_clean();

        $this->assertContains('input.min.js', $output);
    }
}
