<?php
namespace Trendwerk\AcfForms\Test;

use BadMethodCallException;
use Trendwerk\AcfForms\Form\Forms;

class FormsTest extends \WP_UnitTestCase
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
}
