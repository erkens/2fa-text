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

Upgrade to 2.1
--------------
To upgrade, you only need to have to upgrade PHP to at least 8.0 and use the 6.x version of scheb/2fa