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
            'type'  => 'Text',
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
}
