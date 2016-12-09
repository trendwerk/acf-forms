<?php
namespace Trendwerk\AcfForms\Test;

use Trendwerk\AcfForms\Form\Forms;
use Trendwerk\AcfForms\Handler\Handlers;

class HandlersTest extends TestCase
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
        // remove default handlers
        remove_all_actions('acf/save_post');

        // setup mock handler
        $mockHandler = new MockHandler();

        $handlers = new Handlers([$mockHandler]);
        $handlers->init();

        // test non-success
        $this->assertFalse($mockHandler->success);

        // save post
        $entry = $this->createEntry($this->fieldGroups);

        $_POST = [
            'acf'  => true,
            'form' => $this->formName,
        ];

        acf_save_post($entry->getId());

        // test success
        $this->assertTrue($mockHandler->success);
    }
}
