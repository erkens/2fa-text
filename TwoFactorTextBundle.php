<?php

declare(strict_types=1);

namespace Erkens\Security\TwoFactorTextBundle;

use Erkens\Security\TwoFactorTextBundle\DependencyInjection\Compiler\TextCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class TwoFactorTextBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new TextCompilerPass());
    }
}
