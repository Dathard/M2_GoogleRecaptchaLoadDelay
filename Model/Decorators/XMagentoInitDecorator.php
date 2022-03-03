<?php

namespace Dathard\GoogleRecaptchaLoadDelay\Model\Decorators;

use DOMElement;

class XMagentoInitDecorator implements DecoratorInterface
{
    /**
     * @inheritDoc
     */
    public function decorate(DOMElement $script): string
    {
        $script->setAttribute('type', 'recaptcha-defer-load');
        $scriptHtml = $script->ownerDocument->saveHTML($script);

        return $scriptHtml . $this->getDeferLoadScript();
    }

    /**
     * @return string
     */
    private function getDeferLoadScript(): string
    {
        return <<<SCRIPT
<script type="text/javascript">
    require(['jquery', 'domReady!'], function ($) {
        document.addEventListener('mouseover', initGoogleRecaptcha);
        window.addEventListener('scroll', initGoogleRecaptcha);
        document.addEventListener('click', initGoogleRecaptcha);

        function initGoogleRecaptcha() {
            var deferScripts = $('script[type=recaptcha-defer-load]');
            deferScripts.attr("type", "text/x-magento-init");
            deferScripts.wrapAll('<div id="recaptcha-defer-load"></div>');

            $('div#recaptcha-defer-load').trigger('contentUpdated');

            document.removeEventListener('mouseover', initGoogleRecaptcha);
            window.removeEventListener('scroll', initGoogleRecaptcha);
            document.removeEventListener('click', initGoogleRecaptcha);
        }
    });
</script>
SCRIPT;
    }
}
