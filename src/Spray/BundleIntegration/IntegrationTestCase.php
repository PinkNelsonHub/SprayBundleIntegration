<?php

namespace Spray\BundleIntegration;

use PHPUnit_Framework_TestCase;
use Symfony\Component\Config\Loader\LoaderInterface;
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
     * @after
     */
    public function destroyAppKernel()
    {
        $this->kernel = null;
    }
    
    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        
    }
    
    /**
     * @return ContainerInterface
     */
    protected function createContainer()
    {
        return $this->createKernel()->getContainer();
    }
}
