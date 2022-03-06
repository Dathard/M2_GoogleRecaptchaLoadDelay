<?php

namespace Dathard\GoogleRecaptchaLoadDelay\Plugin\MagentoUi;

use Dathard\GoogleRecaptchaLoadDelay\Plugin\AbstractOptimizerPlugin;
use Magento\ReCaptchaUi\Block\ReCaptcha;

class DelayLoadPlugin extends AbstractOptimizerPlugin
{
    protected $searchPattern = '/<script.*text\/x\-magento\-init([\s\S]*?)<\/script>/';

    /**
     * @param ReCaptcha $subject
     * @param string $result
     * @return string
     */
    public function afterToHtml(
        ReCaptcha $subject,
        string $result
    ): string {
        return $this->prepare($result);
    }
}
