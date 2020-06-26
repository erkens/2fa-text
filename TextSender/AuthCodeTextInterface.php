<?php

declare(strict_types=1);

namespace Erkens\Security\TwoFactorTextBundle\TextSender;

use Erkens\Security\TwoFactorTextBundle\Model\TwoFactorTextInterface;

interface AuthCodeTextInterface
{
    /**
     * Send the auth code to the user via text
     *
     * @param TwoFactorTextInterface $user
     */
    public function sendAuthCode(TwoFactorTextInterface $user, string $format): void;
}
