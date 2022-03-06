<?php

namespace Dathard\GoogleRecaptchaLoadDelay\Plugin;

use Dathard\GoogleRecaptchaLoadDelay\Model\Processor;

class AbstractOptimizerPlugin
{
    protected $searchPattern = '/<script[\s\S]*?\/script>/';

    /**
     * @var Processor
     */
    private $processor;

    /**
     * @param Processor $processor
     */
    public function __construct(
        Processor $processor
    ) {
        $this->processor = $processor;
    }

    /**
     * Prepare recaptcha connection script for delay loading
     *
     * @param string $html
     * @return string
     */
    protected function prepare(string $html): string
    {
        preg_match_all($this->searchPattern, $html,  $scripts);
        $scripts = array_shift($scripts);

        foreach ($scripts as $script) {
            $html = str_replace($script, $this->processor->process($script), $html);
        }

        return $html;
    }
}
