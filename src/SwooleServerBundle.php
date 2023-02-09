<?php
declare(strict_types=1);

namespace VolodymyrKlymniuk\SwooleServerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use VolodymyrKlymniuk\SwooleServerBundle\DependencyInjection\CompilerPass\DoctrineCleanerSubscriberPass;

class SwooleServerBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new DoctrineCleanerSubscriberPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 100);
    }
}