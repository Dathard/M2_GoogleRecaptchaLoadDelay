<?php

namespace Dathard\GoogleRecaptchaLoadDelay\Model\Decorators;

use DOMElement;

interface DecoratorInterface
{
    /**
     * Decorate script tag content for delay loading
     *
     * @param DOMElement $script
     * @return string
     */
    public function decorate(DOMElement $script): string;
}
