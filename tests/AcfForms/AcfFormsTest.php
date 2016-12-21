<?php
namespace Trendwerk\AcfForms\Test;

use Trendwerk\AcfForms\Form\Forms;

class AcfFormsTest extends TestCase
{
    public function testRegister()
    {
        global $acfForms;

        $name = 'test';

        $acfForms->register($name, [
            'acfForm'          => [
                'field_groups' => ['testFieldGroup'],
            ],
        ]);

        $forms = Forms::getInstance();
        $form = $forms->get($name);

        $this->assertArrayHasKey('acfForm', $form);
    }
}
