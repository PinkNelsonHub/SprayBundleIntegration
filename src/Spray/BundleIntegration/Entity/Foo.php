<?php

namespace Spray\BundleIntegration\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Foo
 * 
 * @ORM\Entity
 */
class Foo
{
    /**
     * @var integer
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string") 
     */
    private $name;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setName($name)
    {
        $this->name = (string) $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
}
