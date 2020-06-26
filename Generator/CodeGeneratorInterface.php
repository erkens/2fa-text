<?php

declare(strict_types=1);

namespace Erkens\Security\TwoFactorTextBundle\Generator;

use Erkens\Security\TwoFactorTextBundle\Model\TwoFactorTextInterface;

interface CodeGeneratorInterface
{
    /**
     * Generate a new authentication code an send it to the user.
     */
    public function generateAndSend(TwoFactorTextInterface $user): void;
}
