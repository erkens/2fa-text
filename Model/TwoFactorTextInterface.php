<?php

declare(strict_types=1);

namespace Erkens\Security\TwoFactorTextBundle\Model;

interface TwoFactorTextInterface
{
    /**
     * Return true if the user should do two-factor authentication.
     */
    public function isTextAuthEnabled(): bool;

    /**
     * Return user text number, please note that the format of this number can vary
     */
    public function getTextAuthRecipient(): string;

    /**
     * Return the authentication code.
     */
    public function getTextAuthCode(): string;

    /**
     * Set the authentication code.
     */
    public function setTextAuthCode(string $authCode): void;
}
