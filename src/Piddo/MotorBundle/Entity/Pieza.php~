<?php

namespace Piddo\MotorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Piddo\AdminBundle\Util\Util;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pieza
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\MotorBundle\Entity\PiezaRepository")
 */
class Pieza
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
     * @Assert\NotBlank(message="Primero crea un grupo")
     * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\GrupoPieza", inversedBy = "piezas")
     */
    private $grupoPieza;


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
     * @return Pieza
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
     * @return Pieza
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
     * Set grupoPieza
     *
     * @param \Piddo\MotorBundle\Entity\GrupoPieza $grupoPieza
     * @return Pieza
     */
    public function setGrupoPieza(\Piddo\MotorBundle\Entity\GrupoPieza $grupoPieza = null)
    {
        $this->grupoPieza = $grupoPieza;
    
        return $this;
    }

    /**
     * Get grupoPieza
     *
     * @return \Piddo\MotorBundle\Entity\GrupoPieza 
     */
    public function getGrupoPieza()
    {
        return $this->grupoPieza;
    }
}