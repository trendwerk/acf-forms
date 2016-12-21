<?php
namespace Trendwerk\AcfForms\Test\Renderer;

use Trendwerk\AcfForms\Renderer\FieldFactory;
use Trendwerk\AcfForms\Test\TestCase;

class RenderersTest extends TestCase
{
    private $entry;

    public function setUp()
    {
        parent::setUp();

        $this->entry = $this->createEntry();
    }

    public function testField()
    {
        $field = [
            'key'   => 'field_firstName',
            'label' => 'First Name',
            'type'  => 'text',
            'value' => 'Hallo',
        ];

        $renderer = FieldFactory::create($field);

        $this->assertContains($field['label'], $renderer->render($this->entry));
        $this->assertContains($field['value'], $renderer->render($this->entry));
        $this->assertNotContains($field['label'], $renderer->render($this->entry, false));
    }

    public function testPostObject()
    {
        $post = $this->factory->post->create_and_get();

        $field = [
            'key'           => 'field_post',
            'label'         => 'Post Object',
            'type'          => 'post_object',
            'value'         => $post,
            'return_format' => 'object',
        ];

        $renderer = FieldFactory::create($field);

        $this->assertContains($field['label'], $renderer->render($this->entry));
        $this->assertContains($post->post_title, $renderer->render($this->entry));
        $this->assertNotContains($field['label'], $renderer->render($this->entry, false));
    }

    public function testPostObjectReturnId()
    {
        $post = $this->factory->post->create_and_get();

        $field = [
            'key'           => 'field_post',
            'label'         => 'Post Object',
            'type'          => 'post_object',
            'value'         => $post->ID,
            'return_format' => 'id',
        ];

        $renderer = FieldFactory::create($field);

        $this->assertContains($field['label'], $renderer->render($this->entry));
        $this->assertContains($post->post_title, $renderer->render($this->entry));
        $this->assertNotContains($field['label'], $renderer->render($this->entry, false));
    }

    public function testRepeater()
    {
        $post = $this->factory->post->create_and_get();

        $subFields = [
            [
                'key'       => 'field_firstName',
                'label'     => 'First Name',
                'name'      => 'firstName',
                'type'      => 'text',
            ],
            [
                'key'       => 'field_lastName',
                'label'     => 'Last Name',
                'name'      => 'lastName',
                'type'      => 'text',
            ],
        ];

        $values = [
            [
                'firstName' => 'Tester',
                'lastName'  => 'McTest',
            ],
            [
                'firstName' => 'Foo',
                'lastName'  => 'Bar',
            ],
        ];

        $field = [
            'key'           => 'field_repeater',
            'label'         => 'Repeater',
            'sub_fields'    => $subFields,
            'type'          => 'repeater',
            'value'         => $values,
            'return_format' => 'id',
        ];

        $renderer = FieldFactory::create($field);
        $output = $renderer->render($this->entry);

        $this->assertEquals((count($subFields) + 1), substr_count($output, '<tr>'));

        foreach ($subFields as $subField) {
            $this->assertContains($subField['label'], $output);

            foreach ($values as $value) {
                $this->assertContains($value[$subField['name']], $output);
            }
        }
    }

    public function testTab()
    {
        $field = [
            'key'   => 'field_tab',
            'label' => 'Tab',
            'type'  => 'tab',
        ];

        $secondField = [
            'key'   => 'field_secondTab',
            'label' => 'Second Tab',
            'type'  => 'tab',
        ];

        $renderer = FieldFactory::create($field);
        $secondRenderer = FieldFactory::create($secondField);

        $this->assertEquals('<h2>' . $field['label'] . '</h2>', $renderer->render($this->entry));
        $this->assertEquals('<hr><h2>' . $secondField['label'] . '</h2>', $secondRenderer->render($this->entry));
    }
}
