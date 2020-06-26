<?php

declare(strict_types=1);

namespace Erkens\Security\TwoFactorTextBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\LogicException;

class TextCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition('scheb_two_factor.provider_registry')) {
            return;
        }

        if (!$container->hasDefinition('two_factor_text.security.provider')) {
            return;
        }

        if ($container->hasAlias('two_factor_text.security.auth_code_sender')) {
            return;
        }

        $message = 'Sender service for "two_factor_text.security.text.auth_code_sender" is not configured.';
        throw new LogicException($message);
    }
}
