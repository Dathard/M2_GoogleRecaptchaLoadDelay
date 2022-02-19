<?php

namespace Dathard\GoogleRecaptchaLoadDelay\Model\Decorators;

use DOMElement;

class DefaultDecorator implements DecoratorInterface
{
    /**
     * @inheritDoc
     */
    public function decorate(DOMElement $script): string
    {
        $script->nodeValue = $this->prepareNodeValue($script->nodeValue);

        return $script->ownerDocument->saveHTML($script);;
    }

    /**
     * @param string $nodeValue
     * @return string
     */
    private function prepareNodeValue(string $nodeValue): string
    {
        return <<<SCRIPT
require(['domReady!'], () => {
    document.addEventListener('mouseover', initGoogleRecaptcha);
    window.addEventListener('scroll', initGoogleRecaptcha);
    document.addEventListener('click', initGoogleRecaptcha);

    function initGoogleRecaptcha() {
        document.removeEventListener('mouseover', initGoogleRecaptcha);
        window.removeEventListener('scroll', initGoogleRecaptcha);
        document.removeEventListener('click', initGoogleRecaptcha);

        $nodeValue
    }
});
SCRIPT;
    }
}
