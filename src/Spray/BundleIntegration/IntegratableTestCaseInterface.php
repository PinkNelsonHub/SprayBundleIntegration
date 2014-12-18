<?php

namespace Spray\BundleIntegration;

use Symfony\Component\Config\Loader\LoaderInterface;

/**
 * IntegratableTestCaseInterface
 */
interface IntegratableTestCaseInterface
{
    /**
     * Register bundles just how you're used to in your application Kernel:
     * return an array of bundles
     * 
     * @return array<Bundle>
     */
    public function registerBundles();
    
    /**
     * Register container configuration just how you're used to in your
     * application Kernel: call $loader->load() with your preferred type of
     * configuration
     * 
     * @param LoaderInterface $loader
     * @return void
     */
    public function registerContainerConfiguration(LoaderInterface $loader);
    
    /**
     * Should return true if container is compiled in the test manually (usefull
     * for overriding container services with mocks)
     * 
     * @return boolean
     */
    public function isContainerManuallyCompiled();
}
