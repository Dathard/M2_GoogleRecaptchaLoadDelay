<?php

namespace Dathard\GoogleRecaptchaLoadDelay\Model;

use Dathard\GoogleRecaptchaLoadDelay\Model\Decorators\DefaultDecorator;
use DOMDocument;

class Processor
{
    /**
     * @var Decorators\DefaultDecorator
     */
    private $defaultDecorator;

    /**
     * @var array
     */
    private $customDecorators;

    /**
     * @param DefaultDecorator $defaultDecorator
     * @param array $customDecorators
     */
    public function __construct(
        DefaultDecorator $defaultDecorator,
        array $customDecorators = []
    ) {
        $this->defaultDecorator = $defaultDecorator;
        $this->customDecorators = $customDecorators;
    }

    /**
     * Prepare recaptcha connection script for delay loading
     *
     * @param string $scriptString
     * @return string
     */
    public function process(string $scriptString): string
    {
        $doc = new DOMDocument();
        $doc->loadHTML($scriptString);
        $script = $doc->getElementsByTagName('script')[0];
        $scriptType = $script->getAttribute('type');

        if (array_key_exists($scriptType, $this->customDecorators)) {
            return $this->customDecorators[$scriptType]->decorate($script);
        }

        return $this->defaultDecorator->decorate($script);
    }
}
