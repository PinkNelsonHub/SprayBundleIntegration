<?php

namespace Spray\BundleIntegration;

use org\bovigo\vfs\vfsStream;
use Symfony\Component\Config\Loader\LoaderInterface;
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
     * @var boolean
     */
    protected $loadClassCache = false;
    
    /**
     * Construct a new IntegrationKernel
     * 
     * @param IntegratableTestCaseInterface $testCase
     */
    public function __construct(IntegratableTestCaseInterface $testCase)
    {
        $this->testCase = $testCase;
        parent::__construct('integration_' . uniqid(), true);
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
}
