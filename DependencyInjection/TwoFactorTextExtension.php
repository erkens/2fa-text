<?php

declare(strict_types=1);

namespace Erkens\Security\TwoFactorTextBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;

class TwoFactorTextExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // if not enabled, don't load it
        if (isset($config['enabled']) && true === $config['enabled']) {
            $this->configureTextAuthenticationProvider($container, $config);
        }
    }

    public function getAlias(): string
    {
        return 'two_factor_text';
    }

    private function configureTextAuthenticationProvider(ContainerBuilder $container, array $config): void
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('two_factor_provider_text.xml');

        $container->setParameter($this->getAlias() . '.enabled', $config['enabled']);
        $container->setParameter($this->getAlias() . '.template', $config['template']);
        $container->setParameter($this->getAlias() . '.digits', $config['digits']);
        $container->setParameter($this->getAlias() . '.text', $config['text']);
        $container->setAlias($this->getAlias() . '.security.code_generator', $config['code_generator'])->setPublic(true);
        $container->setAlias($this->getAlias() . '.security.auth_code_sender', $config['auth_code_sender']);
    }

    public function prepend(ContainerBuilder $container): void
    {
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);
        // Load two-factor modules
        if (isset($config['enabled']) && true === $config['enabled']) {
            $this->configureTextAuthenticationProvider($container, $config);
        }
    }
}
