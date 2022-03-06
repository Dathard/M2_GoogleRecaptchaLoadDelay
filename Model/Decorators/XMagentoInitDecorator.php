<?php

namespace Dathard\GoogleRecaptchaLoadDelay\Model\Decorators;

use DOMElement;

class XMagentoInitDecorator implements DecoratorInterface
{
    private $useDeferLoadScript = false;

    /**
     * @inheritDoc
     */
    public function decorate(DOMElement $script): string
    {
        $this->useDeferLoadScript = true;
        $script->setAttribute('type', 'recaptcha-defer-load');

        return $script->ownerDocument->saveHTML($script);
    }

    /**
     * @return bool
     */
    public function useDeferLoadScript(): bool
    {
        return $this->useDeferLoadScript;
    }
}
