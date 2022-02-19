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
        $script->setAttribute('type', 'defer-load');
        $scriptHtml = $script->ownerDocument->saveHTML($script);
        $deferLoadScript = $this->getDeferLoadScript();

        return <<<HTML
<div class="x-magento-init-defer-load">$scriptHtml</div>
$deferLoadScript
HTML;
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
            var deferScriptWrapper = $('div.x-magento-init-defer-load');
            deferScriptWrapper.children(":first").attr("type", "text/x-magento-init");
            deferScriptWrapper.trigger('contentUpdated');

            document.removeEventListener('mouseover', initGoogleRecaptcha);
            window.removeEventListener('scroll', initGoogleRecaptcha);
            document.removeEventListener('click', initGoogleRecaptcha);
        }
    });
</script>
SCRIPT;
    }
}
