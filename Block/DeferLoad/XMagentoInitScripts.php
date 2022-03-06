<?php

namespace Dathard\GoogleRecaptchaLoadDelay\Block\DeferLoad;

use Dathard\GoogleRecaptchaLoadDelay\Model\Decorators\XMagentoInitDecorator;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class XMagentoInitScripts extends Template
{
    /**
     * @var XMagentoInitDecorator
     */
    private $decorator;

    /**
     * @param XMagentoInitDecorator $decorator
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        XMagentoInitDecorator $decorator,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->decorator = $decorator;
    }

    public function toHtml()
    {
        if (! $this->decorator->useDeferLoadScript()) {
            return '';
        }

        return $this->getDeferLoadScript();
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