<?php

namespace Spray\BundleIntegration;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle;
use Spray\BundleIntegration\Entity\Foo;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;

/**
 * ORMTest
 */
class ORMIntegrationTest extends ORMIntegrationTestCase
{
    public function registerBundles()
    {
        return array(
            new FrameworkBundle(),
            new DoctrineBundle(),
            new SensioFrameworkExtraBundle(),
            new IntegrationBundle(),
        );
    }
    
    public function testFooIsPersisted()
    {
        $foo = new Foo();
        $foo->setName('bar');
        
        $manager = $this->createEntityManager();
        $manager->persist($foo);
        $manager->flush();
        
        $this->assertSame(
            $foo,
            $manager->find('Spray\BundleIntegration\Entity\Foo', 2)
        );
    }
    
    public function testFooIsRemoved()
    {
        $manager = $this->createEntityManager();
        $foo     = $manager->find('Spray\BundleIntegration\Entity\Foo', 1);
        $manager->remove($foo);
        $manager->flush();
        
        $this->assertNull($manager->find('Spray\BundleIntegration\Entity\Foo', 1));
    }
    
}
