<?php
declare(strict_types=1);

namespace VolodymyrKlymniuk\SwooleServerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('swoole_server', 'array');

        $rootNode
            ->children()
                ->scalarNode('host')->defaultValue('0.0.0.0')->end()
                ->integerNode('port')->defaultValue(80)->end()
                ->arrayNode('options')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('pid_file')
                            ->cannotBeEmpty()
                            ->defaultValue('/var/run/swoole_server.pid')
                        ->end()
                        ->scalarNode('log_file')
                            ->cannotBeEmpty()
                            ->defaultValue('%kernel.logs_dir%/swoole.log')
                        ->end()
                        ->booleanNode('daemonize')
                            ->defaultFalse()
                        ->end()
                        ->scalarNode('document_root')
                            ->cannotBeEmpty()
                            ->defaultValue('%kernel.project_dir%/public')
                        ->end()
                        ->booleanNode('enable_static_handler')
                            ->defaultTrue()
                        ->end()
                        ->variableNode('max_request')
                            ->defaultValue(500)
                        ->end()
                        ->variableNode('open_cpu_affinity')->end()
                        ->variableNode('enable_port_reuse')->end()
                        ->variableNode('dispatch_mode')
                            ->defaultValue(2)
                        ->end()
                        ->variableNode('worker_num')
                            ->defaultValue(4)
                        ->end()
                        ->variableNode('reactor_num')
                            ->defaultValue(4)
                        ->end()
                        ->variableNode('user')->end()
                        ->variableNode('group')->end()
                    ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}