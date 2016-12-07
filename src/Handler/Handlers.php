<?php
namespace Trendwerk\AcfForms\Handler;

use Trendwerk\AcfForms\Entry\Entries;
use Trendwerk\AcfForms\Entry\Entry;
use Trendwerk\AcfForms\Form\Form;
use Trendwerk\AcfForms\Form\Forms;

final class Handlers
{
    private $handlers;

    public function __construct($handlers = [])
    {
        $this->handlers = $handlers;
    }

    public function init()
    {
        add_action('acf/save_post', [$this, 'handle']);
    }

    public function handle($postId)
    {
        if (get_post_type($postId) != Entries::POST_TYPE) {
            return;
        }

        $entry = Entry::find($postId);

        $formName = esc_attr($_POST['form']);
        $forms = Forms::getInstance();
        $form = $forms->get($formName);

        foreach ($this->handlers as $handler) {
            $this->run($handler, $form, $entry);
        }
    }

    private function run(HandlerInterface $handler, array $form, Entry $entry)
    {
        $handler->handle($form, $entry);
    }
}
