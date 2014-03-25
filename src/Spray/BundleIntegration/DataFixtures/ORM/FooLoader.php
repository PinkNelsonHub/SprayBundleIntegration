<?php

namespace Spray\BundleIntegration\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Spray\BundleIntegration\Entity\Foo;

/**
 * FooLoader
 */
class FooLoader extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $foo = new Foo();
        $foo->setName('foo');
        $manager->persist($foo);
        $manager->flush();
    }
}
