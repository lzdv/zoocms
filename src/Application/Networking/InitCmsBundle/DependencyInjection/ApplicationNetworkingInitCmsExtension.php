<?php

namespace Application\Networking\InitCmsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ApplicationNetworkingInitCmsExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
    
    /**
    public function registerDoctrineMapping(array $config)
    {
        $collector = DoctrineCollector::getInstance();

        $collector->addAssociation($config['class']['media'], 'mapOneToMany', array(
            'fieldName'     => 'galleryHasMedias',
            'targetEntity'  => $config['class']['gallery_has_media'],
            'cascade'       => array(
                'persist',
            ),
            'mappedBy'      => 'media',
            'orphanRemoval' => false,
        ));

        $collector->addAssociation($config['class']['gallery_has_media'], 'mapManyToOne', array(
            'fieldName'     => 'gallery',
            'targetEntity'  => $config['class']['gallery'],
            'cascade'       => array(
                'persist',
            ),
            'mappedBy'      => NULL,
            'inversedBy'    => 'galleryHasMedias',
            'joinColumns'   =>  array(
                array(
                    'name'  => 'gallery_id',
                    'referencedColumnName' => 'id',
                ),
            ),
            'orphanRemoval' => false,
        ));

        $collector->addAssociation($config['class']['gallery_has_media'], 'mapManyToOne', array(
            'fieldName'     => 'media',
            'targetEntity'  => $config['class']['media'],
            'cascade'       => array(
                 'persist',
            ),
            'mappedBy'      => NULL,
            'inversedBy'    => 'galleryHasMedias',
            'joinColumns'   => array(
                array(
                    'name'  => 'media_id',
                    'referencedColumnName' => 'id',
                ),
            ),
            'orphanRemoval' => false,
        ));

        $collector->addAssociation($config['class']['gallery'], 'mapOneToMany', array(
            'fieldName'     => 'galleryHasMedias',
            'targetEntity'  => $config['class']['gallery_has_media'],
            'cascade'       => array(
                'persist',
            ),
            'mappedBy'      => 'gallery',
            'orphanRemoval' => true,
            'orderBy'       => array(
                'position'  => 'ASC',
            ),
        ));
    }//*/
}
