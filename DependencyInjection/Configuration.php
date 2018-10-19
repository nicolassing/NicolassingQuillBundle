<?php

namespace Nicolassing\QuillBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Nicolas Assing <nicolas.assing@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('nicolassing_quill');

        $supportedThemes = array('snow', 'bubble');

        $rootNode
            ->children()
                ->scalarNode('theme')
                    ->validate()
                        ->ifNotInArray($supportedThemes)
                        ->thenInvalid('The theme %s is not supported. Please choose one of '.json_encode($supportedThemes))
                    ->end()
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->defaultValue('snow')
                ->end()
                ->scalarNode('height')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->defaultValue('10rem')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

}
