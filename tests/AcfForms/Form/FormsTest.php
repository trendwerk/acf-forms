<?php
namespace Trendwerk\AcfForms\Test\Form;

use BadMethodCallException;
use InvalidArgumentException;
use Trendwerk\AcfForms\Form\Forms;
use Trendwerk\AcfForms\Test\TestCase;

class FormsTest extends TestCase
{
    private $forms;

    public function setUp()
    {
        parent::setUp();

        $this->forms = Forms::getInstance();
    }

    public function testAddWithoutOptions()
    {
        $this->expectException(BadMethodCallException::class);
        $this->forms->add('test', []);
    }

    public function testAdd()
    {
        $name = 'test';
        $fieldGroups = ['test_field_group'];

        $this->forms->add($name, [
            'acfForm'          => [
                'field_groups' => $fieldGroups,
            ],
        ]);

        $form = $this->forms->get($name);

        $this->assertEquals($form['acfForm']['field_groups'], $fieldGroups);
    }

    public function testAddNoName()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->forms->add('', []);
    }

    public function testInvalidGet()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->forms->get('testGet');
    }

    public function testRemove()
    {
        $name = 'test';

        $this->forms->add($name, [
            'acfForm'          => [
                'field_groups' => [],
            ],
        ]);

        $this->assertArrayHasKey('acfForm', $this->forms->get($name));

        $this->forms->remove($name);

        $this->expectException(InvalidArgumentException::class);
        $this->forms->get($name);
    }

    public function testRemoveInvalid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->forms->remove('testGet');
    }
}
