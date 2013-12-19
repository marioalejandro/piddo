<?php

namespace Piddo\MotorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Piddo\AdminBundle\Util\Util;

/**
 * Serie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\MotorBundle\Entity\SerieRepository")
 */
class Serie
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
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\Marca")
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\Modelo")
     */
    private $modelo;

    
    /**
     * 
     * @ORM\OneToMany(targetEntity="Piddo\MotorBundle\Entity\ColPiezas", mappedBy="serie", cascade={"persist"})
     */
    protected $piezasDisponibles;
    
 

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
     * @return Serie
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
     * @return Serie
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


    /**
     * Set marca
     *
     * @param \Piddo\MotorBundle\Entity\Marca $marca
     * @return Serie
     */
    public function setMarca(\Piddo\MotorBundle\Entity\Marca $marca = null)
    {
        $this->marca = $marca;
    
        return $this;
    }

    /**
     * Get marca
     *
     * @return \Piddo\MotorBundle\Entity\Marca 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set modelo
     *
     * @param \Piddo\MotorBundle\Entity\Modelo $modelo
     * @return Serie
     */
    public function setModelo(\Piddo\MotorBundle\Entity\Modelo $modelo = null)
    {
        $this->modelo = $modelo;
    
        return $this;
    }

    public function __toString() {
        return $this->getNombre();
    }

    /**
     * Get modelo
     *
     * @return \Piddo\MotorBundle\Entity\Modelo 
     */
    public function getModelo()
    {
        return $this->modelo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->piezasDisponibles = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add piezasDisponibles
     *
     * @param \Piddo\MotorBundle\Entity\ColPiezas $piezasDisponibles
     * @return Serie
     */
    public function addPiezasDisponible(\Piddo\MotorBundle\Entity\ColPiezas $piezasDisponibles)
    {
        $this->piezasDisponibles[] = $piezasDisponibles;
    
        return $this;
    }

    /**
     * Remove piezasDisponibles
     *
     * @param \Piddo\MotorBundle\Entity\ColPiezas $piezasDisponibles
     */
    public function removePiezasDisponible(\Piddo\MotorBundle\Entity\ColPiezas $piezasDisponibles)
    {
        $this->piezasDisponibles->removeElement($piezasDisponibles);
    }

    /**
     * Get piezasDisponibles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPiezasDisponibles()
    {
        return $this->piezasDisponibles;
    }
}