<?php

namespace Piddo\MotorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Piddo\AdminBundle\Util\Util;

/**
 * GrupoPieza
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\MotorBundle\Entity\GrupoPiezaRepository")
 */
class GrupoPieza
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     *
     * @var type 
     * 
     * @ORM\OneToMany(targetEntity="Piddo\MotorBundle\Entity\Pieza", mappedBy="grupoPieza")
     */
    
    private $piezas;
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return GrupoPieza
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        $this->slug = Util::getSlug($nombre);
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return GrupoPieza
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    public function __toString() {
        return $this->getNombre();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->piezas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add piezas
     *
     * @param \Piddo\MotorBundle\Entity\Pieza $piezas
     * @return GrupoPieza
     */
    public function addPieza(\Piddo\MotorBundle\Entity\Pieza $piezas)
    {
        $this->piezas[] = $piezas;
    
        return $this;
    }

    /**
     * Remove piezas
     *
     * @param \Piddo\MotorBundle\Entity\Pieza $piezas
     */
    public function removePieza(\Piddo\MotorBundle\Entity\Pieza $piezas)
    {
        $this->piezas->removeElement($piezas);
    }

    /**
     * Get piezas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPiezas()
    {
        return $this->piezas;
    }
}