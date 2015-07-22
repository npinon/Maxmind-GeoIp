<?php

namespace Maxmind\Bundle\GeoipBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('maxmind_geoip');

        $path = '%kernel.root_dir%/Resources/geodb/';
        $name = 'GeoLite2-City.mmdb';
        $language = 'fr';

        $rootNode
        	->children()
        		->scalarNode("data_file_path")->isRequired()->cannotBeEmpty()->defaultValue($path)->end()
                ->scalarNode("data_file_name")->isRequired()->cannotBeEmpty()->defaultValue($name)->end()
                ->scalarNode("language")->isRequired()->cannotBeEmpty()->defaultValue($language)->end()
        	->end();

        return $treeBuilder;
    }
}
