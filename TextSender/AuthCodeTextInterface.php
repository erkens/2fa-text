<?php

declare(strict_types=1);

namespace Erkens\Security\TwoFactorTextBundle\TextSender;

use Erkens\Security\TwoFactorTextBundle\Model\TwoFactorTextInterface;

interface AuthCodeTextInterface
{
    /**
     * Sets the message that will be sent to the user (%s will be replaced by the code)
     */
    public function setMessageFormat(string $format): void;
    public function getMessageFormat(): string;


    /**
     * Send the auth code to the user via text
     *
     * @param TwoFactorTextInterface $user
     * @param string|null $code
     */
    public function sendAuthCode(TwoFactorTextInterface $user, ?string $code): void;
}
