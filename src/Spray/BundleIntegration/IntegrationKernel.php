<?php

namespace Spray\BundleIntegration;

use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

/**
 * IntegrationKernel
 */
class IntegrationKernel extends Kernel
{
    /**
     * @var IntegratableTestCaseInterface 
     */
    private $testCase;
    
    /**
     * Construct a new IntegrationKernel
     * 
     * @param IntegratableTestCaseInterface $testCase
     */
    public function __construct(IntegratableTestCaseInterface $testCase)
    {
        $this->testCase = $testCase;
        parent::__construct('integration', false);
    }
    
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        return $this->testCase->registerBundles();
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $this->testCase->registerContainerConfiguration($loader);
    }
    
    /**
     * Overridden to disable any caching
     * 
     * {@inheritdoc}
     */
    protected function doLoadClassCache($name, $extension)
    {
        
    }

    /**
     * Overridden to disable any caching
     * 
     * {@inheritdoc}
     */
    protected function initializeContainer()
    {
        $this->container = $this->buildContainer();
        $this->container->set('kernel', $this);
        $this->container->compile();
    }
    
    /**
     * Overridden to disable any caching
     * 
     * {@inheritdoc}
     */
    protected function buildContainer()
    {
        $container = $this->getContainerBuilder();
        $container->addObjectResource($this);
        $this->prepareContainer($container);
        if (null !== $cont = $this->registerContainerConfiguration($this->getContainerLoader($container))) {
            $container->merge($cont);
        }
        return $container;
    }
    
    /**
     * Overridden to disable any caching
     * 
     * {@inheritdoc}
     */
    protected function dumpContainer(ConfigCache $cache, ContainerBuilder $container, $class, $baseClass)
    {
        
    }

    /**
     * Overridden to disable any caching
     * 
     * {@inheritdoc}
     */
    public function loadClassCache($name = 'classes', $extension = '.php')
    {
        
    }

    /**
     * Overridden to disable any caching
     * 
     * {@inheritdoc}
     */
    public function setClassCache(array $classes)
    {
        
    }
}
