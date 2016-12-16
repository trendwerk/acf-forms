<?php
namespace Trendwerk\AcfForms\Test;

use Trendwerk\AcfForms\Form\Forms;

class AdminTest extends TestCase
{
    private $fieldGroup = 'testFieldGroup';
    private $fields = [
        [
            'key'   => 'field_testField',
            'label' => 'testField',
            'name'  => 'testField',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_anotherField',
            'label' => 'First Name',
            'name'  => 'firstName',
            'type'  => 'text',
        ]
    ];
    private $formName = 'test';

    public function setUp()
    {
        parent::setUp();

        $this->createFieldGroup($this->fieldGroup, $this->fields);

        $forms = Forms::getInstance();
        $forms->add($this->formName, [
            'acfForm'          => [
                'field_groups' => [$this->fieldGroup],
            ],
        ]);
    }

    public function testSend()
    {
        $entry = $this->createEntry();
        $expectedValue = 'testValue';

        $values = [];

        foreach ($this->fields as $field) {
            $values[$field['key']] = $expectedValue;
        }

        $_POST = [
            'acf'  => $values,
            'form' => $this->formName,
        ];

        acf_save_post($entry->getId());

        $mailer = tests_retrieve_phpmailer_instance();
        $sent = $mailer->get_sent();

        $this->assertContains(get_option('admin_email'), $sent->to[0]);
        $this->assertContains($this->fieldGroup, $sent->subject);
        $this->assertContains($expectedValue, $sent->body);

        foreach ($this->fields as $field) {
            $this->assertContains($field['label'], $sent->body);
        }

        $this->assertContains('Content-Type: text/html', $sent->header);
    }

    public function tearDown()
    {
        parent::tearDown();

        $this->destroyFieldGroup($this->fieldGroup);
    }
}
