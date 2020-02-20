<?php

/*
 * This file is part of the FOSUserBundle package.
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nicolassing\QuillBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Nicolas Assing <nicolas.assing@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('nicolassing_quill');
        $rootNode = $treeBuilder->getRootNode();

        $supportedThemes = ['snow', 'bubble'];

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
