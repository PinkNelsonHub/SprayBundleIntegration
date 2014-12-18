<?php

namespace Spray\BundleIntegration;

use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * IntegrationTestCase
 */
abstract class IntegrationTestCase extends PHPUnit_Framework_TestCase
    implements IntegratableTestCaseInterface
{
    /**
     * @var IntegrationKernel
     */
    private $kernel;
    
    /**
     * @return IntegrationKernel
     */
    protected function createKernel()
    {
        if (null === $this->kernel) {
            $this->kernel = new IntegrationKernel($this);
            $this->kernel->boot();
        }
        return $this->kernel;
    }
    
    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/Resources/config/framework.yml');
    }
    
    /**
     * @return ContainerInterface
     */
    protected function createContainer()
    {
        return $this->createKernel()->getContainer();
    }
    
    /**
     * {@inheritdoc}
     */
    public function isContainerManuallyCompiled()
    {
        return false;
    }
}
