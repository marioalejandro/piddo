<?php

namespace Piddo\ClienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cliente
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\ClienteBundle\Entity\ClienteRepository")
 */
class Cliente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $rut;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255)
     */
    private $apellidos;
    
    /**
     * @ORM\OneToMany(targetEntity="Piddo\ClienteBundle\Entity\Telefono", mappedBy="cliente")
     */
    protected $telefonos;
 
    public function __construct()
    {
        $this->telefonos = new ArrayCollection();
    }
    
    
    
    
    /**
     * Set rut
     *
     * @param integer $rut
     * @return Cliente
     */
    public function setRut($rut)
    {
        $this->rut = $rut;
    
        return $this;
    }

    /**
     * Get rut
     *
     * @return integer 
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Cliente
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
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
     * Set apellidos
     *
     * @param string $apellidos
     * @return Cliente
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    
        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }
    
    public function __toString() {
        
        return $this->getNombre();
    }

    /**
     * Add telefonos
     *
     * @param \Piddo\ClienteBundle\Entity\Telefono $telefonos
     * @return Cliente
     */
    public function addTelefono(\Piddo\ClienteBundle\Entity\Telefono $telefonos)
    {
        $this->telefonos[] = $telefonos;
    
        return $this;
    }

    /**
     * Remove telefonos
     *
     * @param \Piddo\ClienteBundle\Entity\Telefono $telefonos
     */
    public function removeTelefono(\Piddo\ClienteBundle\Entity\Telefono $telefonos)
    {
        $this->telefonos->removeElement($telefonos);
    }

    /**
     * Get telefonos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }
    
    
    
    
    /********************************************/
     /**
     * @Assert\Type(type="Piddo\ClienteBundle\Entity\Telefono")
     */
    protected $telefono;
 
    // ...
 
    public function getTelefono()
    {
        return $this->telefono;
    }
 
    public function setTelefono(\Piddo\ClienteBundle\Entity\Telefono $telefono = null)
    {
        $this->telefono = $telefono;
    }
}