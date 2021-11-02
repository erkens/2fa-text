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

First thing to do is make a new service that implements `Erkens\Security\TwoFactorTextBundle\Generator\CodeGeneratorInterface`
so we can actually send a sms or text message. This service can then be used in the configuration as "auth_code_sender":

```
two_factor_text:
    enabled: true
    auth_code_sender: Erkens\Security\TwoFactorTextBundle\TextSender\ExampleTextSender
    digits: 6
    text: 'To login, use this code: %s'
    template: '@SchebTwoFactor/Authentication/form.html.twig'
```

Upgrade to 2.0
--------------
There are two main breaking changes to version 2.0:

- The minimum supported version of PHP is upgraded to 7.4
- In the AuthCodeTextInterface the calling of the method "sendAuthCode" has changed:
  old: sendAuthCode(TwoFactorTextInterface $user, string $format): void;
  new: sendAuthCode(TwoFactorTextInterface $user, ?string $code): void;
    The format/text will be retrieved by the new public method "getMessageFormat" in this way the sender can also be
    used for other messages like a confirmation code. If $code is not passed (null) the old way of getting the code via
    the user object can be taken.
    Note that the default text as specified in the configuration is still used by the default CodeGenerator, 
    see the ExampleTextSender for an example.

License
-------
This software is available under the [MIT license](LICENSE).
