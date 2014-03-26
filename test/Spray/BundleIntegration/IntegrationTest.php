<?php

namespace Spray\BundleIntegration;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;

/**
 * IntegrationTest
 */
class IntegrationTest extends IntegrationTestCase
{
    public function registerBundles()
    {
        return array(
            new FrameworkBundle(),
        );
    }

    public function testFormFactoryIsAvailable()
    {
        $this->assertInstanceOf(
            'Symfony\Component\Form\FormFactory',
            $this->createContainer()->get('form.factory')
        );
    }
}
