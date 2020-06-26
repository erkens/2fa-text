<?php

declare(strict_types=1);

namespace Erkens\Security\TwoFactorTextBundle\Provider;

use Erkens\Security\TwoFactorTextBundle\Generator\CodeGeneratorInterface;
use Erkens\Security\TwoFactorTextBundle\Model\TwoFactorTextInterface;
use Scheb\TwoFactorBundle\Security\TwoFactor\AuthenticationContextInterface;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\TwoFactorFormRendererInterface;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\TwoFactorProviderInterface;

class TextTwoFactorProvider implements TwoFactorProviderInterface
{
    /**
     * @var CodeGeneratorInterface
     */
    private $codeGenerator;

    /**
     * @var TwoFactorFormRendererInterface
     */
    private $formRenderer;

    public function __construct(CodeGeneratorInterface $codeGenerator, TwoFactorFormRendererInterface $formRenderer)
    {
        $this->codeGenerator = $codeGenerator;
        $this->formRenderer = $formRenderer;
    }

    public function beginAuthentication(AuthenticationContextInterface $context): bool
    {
        // Check if user can do text authentication
        $user = $context->getUser();

        return $user instanceof TwoFactorTextInterface && $user->isTextAuthEnabled();
    }

    public function prepareAuthentication($user): void
    {
        if ($user instanceof \Erkens\Security\TwoFactorTextBundle\Model\TwoFactorTextInterface) {
            $this->codeGenerator->generateAndSend($user);
        }
    }

    public function validateAuthenticationCode($user, string $authenticationCode): bool
    {
        if (!($user instanceof \Erkens\Security\TwoFactorTextBundle\Model\TwoFactorTextInterface)) {
            return false;
        }

        // Strip any user added spaces
        $authenticationCode = str_replace(' ', '', $authenticationCode);

        return $user->getTextAuthCode() === $authenticationCode;
    }

    public function getFormRenderer(): TwoFactorFormRendererInterface
    {
        return $this->formRenderer;
    }
}
