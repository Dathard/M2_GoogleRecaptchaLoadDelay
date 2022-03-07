<?php

namespace Dathard\GoogleRecaptchaLoadDelay\Plugin\MSP;

use Dathard\GoogleRecaptchaLoadDelay\Plugin\AbstractOptimizerPlugin;
use MSP\ReCaptcha\Block\Frontend\ReCaptcha;

class DelayLoadPlugin extends AbstractOptimizerPlugin
{
    /**
     * @param ReCaptcha $subject
     * @param $result
     * @return string
     */
    public function afterToHtml(
        ReCaptcha $subject,
        $result
    ) {
        return $this->prepare($result);
    }
}
