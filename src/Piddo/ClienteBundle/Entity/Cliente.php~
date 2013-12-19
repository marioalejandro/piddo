<?php

namespace Piddo\ClienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Cliente
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\ClienteBundle\Entity\ClienteRepository")
 * @UniqueEntity("rut")
 */
class Cliente
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
     * @Assert\NotBlank(message = "No puede quedar en blanco")
     * @ORM\Column(name="rut", type="string", length=255, unique=true)
     */
    private $rut;

    /**
     * @var string
     * 
     * @Assert\NotBlank()
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     * @ORM\Column(name="apellidos", type="string", length=255, nullable=true)
     */
    private $apellidos;
    
    /**
     * 
     * @ORM\OneToMany(targetEntity="Piddo\ClienteBundle\Entity\Telefono", mappedBy="cliente", cascade={"persist"})
     */
    protected $telefonos;
    
    /*****************************************
     * CONSTRUCTOR
     *****************************************/
 
    public function __construct()
    {
        $this->telefonos = new ArrayCollection();
    }
    
    /*******************************************
     * GETTERS & SETTERS
     ******************************************/
    
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
     * Set rut
     *
     * @param string $rut
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
     * @return string 
     */
    public function getRut()
    {
        return $this->rut;
    }
    
    /*******************************************
     * METODOS
     ******************************************/
    
    
    public function __toString() {
        
        return $this->getNombre();
    }
}