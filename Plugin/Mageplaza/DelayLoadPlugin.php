<?php

namespace Dathard\GoogleRecaptchaLoadDelay\Plugin\Mageplaza;

use Dathard\GoogleRecaptchaLoadDelay\Plugin\AbstractOptimizerPlugin;
use Mageplaza\GoogleRecaptcha\Block\Captcha;

class DelayLoadPlugin extends AbstractOptimizerPlugin
{
    public function afterToHtml(
        Captcha $subject,
        $result
    ) {
        return $this->prepare($result);
    }
}
