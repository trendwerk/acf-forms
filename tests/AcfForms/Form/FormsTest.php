<?php
namespace Trendwerk\AcfForms\Test;

use BadMethodCallException;
use InvalidArgumentException;
use Trendwerk\AcfForms\Form\Forms;

class FormsTest extends TestCase
{
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

    public function testInvalidGet()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->forms->get('testGet');
    }
}
