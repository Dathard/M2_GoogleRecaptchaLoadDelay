## Main functionalities
By default, the captcha is initialized immediately when the page is loaded, even if it is not necessary, and this negatively affects the speed of the site.

This extension allows to delay the initialization of the recaptcha until the user starts interacting with the page (this approach allows to optimize the process of loading the site).

## Events when the extension triggers captcha initialization
- page scroll
- moving cursor around the page
- clicking on the page

## Supported captcha extensions for Magento 2
- Amasty Invisible Captcha
- Mageplaza Google Recaptcha
- MSP ReCaptcha (default for M2.3.*)
- Magento UI Recaptcha (default for M2.4.*)
