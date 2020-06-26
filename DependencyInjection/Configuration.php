<?php

declare(strict_types=1);

namespace Erkens\Security\TwoFactorTextBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('two_factor_text');
        $rootNode = $treeBuilder->getRootNode();

        /**
         * @psalm-suppress PossiblyNullReference
         * @psalm-suppress PossiblyUndefinedMethod
         */
        $rootNode
            ->canBeEnabled()
            ->children()
            ->scalarNode('auth_code_sender')->defaultValue('Erkens\Security\TwoFactorTextBundle\TextSender\ExampleTextSender')->end()
            ->scalarNode('code_generator')->defaultValue('two_factor_text.security.default_code_generator')->end()
            ->scalarNode('template')->defaultValue('@SchebTwoFactor/Authentication/form.html.twig')->end()
            ->integerNode('digits')->defaultValue(6)->min(1)->end()
            ->scalarNode('text')->defaultValue('Use this code to login: %s')->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
