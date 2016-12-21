<?php
namespace Trendwerk\AcfForms\Test\Handler;

use Trendwerk\AcfForms\Form\Forms;
use Trendwerk\AcfForms\Test\TestCase;

class NotificationsTest extends TestCase
{
    private $fieldGroups = ['testFieldGroup'];
    private $formName = 'test';
    private $forms;

    public function setUp()
    {
        parent::setUp();

        $this->forms = Forms::getInstance();
        $this->forms->add($this->formName, [
            'acfForm'          => [
                'field_groups' => $this->fieldGroups,
            ],
            'notifications'    => [
                'Trendwerk\AcfForms\Test\MockNotification',
            ],
        ]);
    }

    public function testHandle()
    {
        global $mockNotificationSuccess;

        $entry = $this->createEntry();

        $_POST = [
            'acf'  => ['testKey' => 'testValue'],
            'form' => $this->formName,
        ];

        $this->assertNull($mockNotificationSuccess);

        acf_save_post($entry->getId());

        $this->assertTrue($mockNotificationSuccess);
    }

    public function tearDown()
    {
        parent::tearDown();

        $this->forms->remove($this->formName);
    }
}
