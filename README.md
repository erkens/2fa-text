erkens/2fa-text
===============

This package extends [scheb/2fa-bundle](https://github.com/scheb/2fa-bundle) with two-factor authentication via text messages.

It is based on the official [scheb/2fa-email](https://github.com/scheb/2fa-email) package.

Usage
-----
After you have installed and configured [scheb/2fa-bundle](https://github.com/scheb/2fa-bundle) you can install this package:

```
composer require erkens/2fa-text
```

First thing to do is make a new service that implements `Erkens\Security\TwoFactorTextBundle\TextSender\AuthCodeTextInterface`
so we can actually send a sms or text message. This service can then be used in the configuration as "auth_code_sender":

```
two_factor_text:
    enabled: true
    auth_code_sender: Erkens\Security\TwoFactorTextBundle\TextSender\ExampleTextSender
    digits: 6
    text: 'To login, use this code: %s'
    template: '@SchebTwoFactor/Authentication/form.html.twig'
```

License
-------
This software is available under the [MIT license](LICENSE).
