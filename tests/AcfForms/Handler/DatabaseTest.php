<?php
namespace Trendwerk\AcfForms\Test;

use Trendwerk\AcfForms\Form\Forms;
use Trendwerk\AcfForms\Handler\Handlers;

class DatabaseTest extends TestCase
{
    private $fieldGroups = ['testFieldGroup'];
    private $formName;

    public function setUp()
    {
        parent::setUp();

        $forms = Forms::getInstance();
        $forms->add($this->formName, [
            'acfForm'          => [
                'field_groups' => $this->fieldGroups,
            ],
        ]);
    }

    public function testHandle()
    {
        $entry = $this->createEntry();

        $this->assertNotEquals($entry->getFieldGroups(), $this->fieldGroups);

        $_POST = [
            'acf'  => ['testKey' => 'testValue'],
            'form' => $this->formName,
        ];

        acf_save_post($entry->getId());

        $this->assertEquals($entry->getFieldGroups(), $this->fieldGroups);
    }
}
