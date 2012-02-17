<?php

namespace Webfactory\Bundle\ExceptionsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {

    public function getConfigTreeBuilder() {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('webfactory_exceptions');
        $rootNode->children()
            ->scalarNode('bundle')
                ->isRequired()
                ->end()
            ->booleanNode('debug')
                ->defaultFalse()
                ->end()
        ;
        return $treeBuilder;
    }

}
