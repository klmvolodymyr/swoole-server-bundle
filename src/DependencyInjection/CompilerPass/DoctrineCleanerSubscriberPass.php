<?php

namespace VolodymyrKlymniuk\SwooleServerBundle\DependencyInjection\CompilerPass;

use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use VolodymyrKlymniuk\SwooleServerBundle\EventSubscriber\DoctrineCleaner;

class DoctrineCleanerSubscriberPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        foreach (['doctrine_mongodb', ManagerRegistry::class] as $definitionId) {
            if ($container->hasDefinition($definitionId)) {
                $definition = new Definition(DoctrineCleaner::class);
                $definition->addTag('kernel.event_subscriber');
                $definition->setArguments([new Reference($definitionId)]);
                $container->setDefinition(uniqid('doctrine.clear.listener.'), $definition);
            }
        }
    }
}