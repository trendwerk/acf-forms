<?php
namespace Trendwerk\AcfForms;

use Trendwerk\AcfForms\Entry\Entries;
use Trendwerk\AcfForms\Entry\Rule;
use Trendwerk\AcfForms\Form\Forms;

final class AcfForms
{
    /**
     * @codeCoverageIgnore
     */
    public function init()
    {
        $entries = new Entries();
        $entries->init();

        $handler = new Handler\Handlers([
            new Handler\Database(),
            new Handler\Notifications(),
        ]);
        $handler->init();

        $rule = new Rule();
        $rule->init();
    }

    public function register($name, array $options = [])
    {
        $forms = Forms::getInstance();
        $forms->add($name, $options);
    }
}
