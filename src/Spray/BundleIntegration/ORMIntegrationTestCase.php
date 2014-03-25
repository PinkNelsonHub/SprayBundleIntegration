<?php

namespace Spray\BundleIntegration;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use InvalidArgumentException;

/**
 * ORMIntegrationTestCase
 */
abstract class ORMIntegrationTestCase extends IntegrationTestCase
{
    public static function setUpBeforeClass()
    {
        var_dump('Registering before class');
        AnnotationRegistry::registerFile('vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');
    }

    /**
     * Return where your fixtures are located
     * 
     * @return array<string>
     */
    public function registerFixturePaths()
    {
        $paths = array();
        foreach ($this->createKernel()->getBundles() as $bundle) {
            $paths[] = $bundle->getPath().'/DataFixtures/ORM';
        }
        return $paths;
    }
    
    /**
     * @return EntityManager
     */
    protected function createEntityManager()
    {
        return $this->createContainer()->get('doctrine.orm.entity_manager');
    }
    
    /**
     * @before
     */
    public function loadFixtures()
    {
        $loader = new DataFixturesLoader($this->createContainer());
        foreach ($this->registerFixturePaths() as $path) {
            if (is_dir($path)) {
                $loader->loadFromDirectory($path);
            }
        }
        $fixtures = $loader->getFixtures();
        if (!$fixtures) {
            throw new InvalidArgumentException(sprintf(
                'Could not find any fixtures to load in: %s',
                "\n\n- ".implode("\n- ", $this->registerFixturePaths())
            ));
        }
        $purger = new ORMPurger($this->createEntityManager());
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $executor = new ORMExecutor($this->createEntityManager(), $purger);
        $executor->execute($fixtures);
    }
}
