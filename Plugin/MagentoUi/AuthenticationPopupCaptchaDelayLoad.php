<?php

namespace Dathard\GoogleRecaptchaLoadDelay\Plugin\MagentoUi;

use Dathard\GoogleRecaptchaLoadDelay\Plugin\AbstractOptimizerPlugin;
use Magento\Customer\Block\Account\AuthenticationPopup;

class AuthenticationPopupCaptchaDelayLoad extends AbstractOptimizerPlugin
{
    protected $searchPattern = '/<script.*text\/x\-magento\-init([\s\S]*?)<\/script>/';

    /**
     * @param AuthenticationPopup $subject
     * @param string $result
     * @return string
     */
    public function afterToHtml(
        AuthenticationPopup $subject,
        string $result
    ): string {
        return $this->prepare($result);
    }
}