<?php

namespace Dathard\GoogleRecaptchaLoadDelay\Plugin\Mageplaza;

use Dathard\GoogleRecaptchaLoadDelay\Plugin\AbstractOptimizerPlugin;
use Mageplaza\GoogleRecaptcha\Block\Captcha;

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
