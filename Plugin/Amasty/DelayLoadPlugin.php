<?php

namespace Dathard\GoogleRecaptchaLoadDelay\Plugin\Amasty;

use Amasty\InvisibleCaptcha\Block\Captcha;
use Dathard\GoogleRecaptchaLoadDelay\Plugin\AbstractOptimizerPlugin;

class DelayLoadPlugin extends AbstractOptimizerPlugin
{
    /**
     * @param Captcha $subject
     * @param $result
     * @return string
     */
    public function afterToHtml(
        Captcha $subject,
        $result
    ) {
        return $this->prepare($result);
    }
}
