<?php
namespace Trendwerk\AcfForms\Handler;

use Trendwerk\AcfForms\Entries;
use Trendwerk\AcfForms\Entry;

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

        foreach ($this->handlers as $handler) {
            $this->run($handler, $entry);
        }
    }

    private function run(HandlerInterface $handler, $entry)
    {
        $handler->handle($entry);
    }
}
