<?php

declare(strict_types=1);

namespace Erkens\Security\TwoFactorTextBundle\Generator;

use Erkens\Security\TwoFactorTextBundle\Model\TwoFactorTextInterface;

interface CodeGeneratorInterface
{
    /**
     * Generate a new authentication code and send it to the user.
     */
    public function generateAndSend(TwoFactorTextInterface $user): void;

    /**
     * Resend the authentication code to the user
     */
    public function reSend(TwoFactorTextInterface $user): void;
}
