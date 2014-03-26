<?php

namespace Spray\BundleIntegration;

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
     * Construct a new IntegrationKernel
     * 
     * @param IntegratableTestCaseInterface $testCase
     */
    public function __construct(IntegratableTestCaseInterface $testCase)
    {
        $this->testCase = $testCase;
        parent::__construct('integration', true);
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
