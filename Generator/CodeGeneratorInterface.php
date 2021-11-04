<?php

declare(strict_types=1);

namespace Erkens\Security\TwoFactorTextBundle\Generator;

use Erkens\Security\TwoFactorTextBundle\Model\TwoFactorTextInterface;

interface CodeGeneratorInterface
{
    /**
     * Generate a new authentication code, stores it in the user object and send it to the user.
     */
    public function generateAndSend(TwoFactorTextInterface $user): void;

    /**
     * Generate a new authentication code (but will not store it in the user object) and send it to the user with a custom text.
     */
    public function returnAndSendWithMessage(TwoFactorTextInterface $user, string $text): string;

    /**
     * Resend the authentication code to the user
     */
    public function reSend(TwoFactorTextInterface $user): void;
}
