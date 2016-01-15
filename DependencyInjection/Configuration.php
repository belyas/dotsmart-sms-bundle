<?php

namespace DotSmart\SmsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration
 *
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dot_smart_sms');

        $rootNode->children()
            ->scalarNode('reference')
                ->info("reference parameter is required sms service")
                ->isRequired()
                ->cannotBeEmpty()
                ->defaultValue(null)
                ->validate()
                    ->ifNull()
                        ->thenUnset('reference parameter is required to send sms')
                    ->end()
            ->end()
            ->scalarNode('key')
                ->info("key is required by sms service")
                ->isRequired()
                ->cannotBeEmpty()
            ->end()
            ->scalarNode('senderid')
                ->info("senderid is required, it can alphanumeric and must not exceed 12 characters")
                ->isRequired()
                ->cannotBeEmpty()
            ->end()
            ->scalarNode('myid')
                ->info("if myid is null, it will be handled in the service during sending sms")
                ->defaultValue(null)
            ->end()
            ->scalarNode('date')
                ->info("if date is null, it will be now")
                ->defaultValue(null)
            ->end()
            ->scalarNode('time')
                ->info("if time is null, it will be now")
                ->defaultValue(null)
            ->end()
            ->scalarNode('life')
                ->info("if life is null, it will be 48h00")
                ->defaultValue(null)
            ->end()
            ->scalarNode('format')
                ->info("format which you will receive from the sms service: json, xml or array")
                ->defaultValue("json")
            ->end()
        ->end();

        return $treeBuilder;
    }
}
