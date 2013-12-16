<?php

namespace Piddo\ClienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Telefono
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\ClienteBundle\Entity\TelefonoRepository")
 */
class Telefono
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
     * @var integer
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;
    
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;
    
   /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Piddo\ClienteBundle\Entity\Cliente", inversedBy="telefonos", cascade={"persist"})
     */
    private $cliente;


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
     * Set numero
     *
     * @param integer $numero
     * @return Telefono
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }


    /**
     * Set cliente
     *
     * @param \Piddo\ClienteBundle\Entity\Cliente $cliente
     * @return Telefono
     */
    public function setCliente(\Piddo\ClienteBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;
    
        return $this;
    }

    /**
     * Get cliente
     *
     * @return \Piddo\ClienteBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Telefono
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    
    public function __toString() {
        
        return (string)$this->getNumero();
    }
}