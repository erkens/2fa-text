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
You can add this in its own yaml file inside `config/packages` or place it within the existing `scheb_2fa.yaml`. But
make sure you have the `two_factor_text` at the root of the yaml-tree (not under `scheb_two_factor`). 

**Next**

Your `User` entity must implement the `Erkens\Security\TwoFactorTextBundle\Model\TwoFactorTextInterface` and implement the required methods.


License
-------
This software is available under the [MIT license](LICENSE).
