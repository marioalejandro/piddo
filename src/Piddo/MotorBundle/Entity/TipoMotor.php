<?php

namespace Piddo\MotorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Piddo\AdminBundle\Util\Util;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Piddo\MotorBundle\Entity\Serie;

/**
 * TipoMotor
 *
 * @UniqueEntity(
 *     fields="nombre",
 *     message="Este grupo ya existe."
 * )
 * 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\TallerBundle\Entity\TipoMotorRepository")
 */
class TipoMotor
{
    
    /************************************************
     * 		ATRIBUTOS
     ***********************************************/
    
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
     * @Assert\NotBlank(message="Debe ingresar un nombre para el Grupo")
     * 
     * @ORM\Column(name="nombre", type="string", length=10)
     */
    private $nombre;

    /**
     * @var string
     * 
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /************************************************
     * 		ATRIBUTOS FOREIGN KEY
     ***********************************************/    
    
     /**
     *
     * @var type 
     * 
     * @ORM\OneToMany(targetEntity="Piddo\MotorBundle\Entity\Serie", mappedBy="tipoMotor")
     */
    private $series;
    
    /************************************************
     * 		CONSTRUCTOR
     ***********************************************/      
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->$series = new \Doctrine\Common\Collections\ArrayCollection();
    }    

    /************************************************
     * 		GETTERS & SETTERS
     ***********************************************/    
    
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
     * @return TipoMotor
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
     * @return TipoMotor
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
    

    /************************************************
     * 		GETTERS & SETTERS FOREIGN KEY
     ***********************************************/  
    
    /**
     * Add series
     *
     * @param \Piddo\MotorBundle\Entity\Serie $series
     * @return TipoMotor
     */
    public function addSerie(\Piddo\MotorBundle\Entity\Serie $series)
    {
        $this->series[] = $series;
    
        return $this;
    }

    /**
     * Remove series
     *
     * @param \Piddo\MotorBundle\Entity\Serie $series
     */
    public function removeSerie(\Piddo\MotorBundle\Entity\Serie $series)
    {
        $this->series->removeElement($series);
    }

    /**
     * Get series
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSeries()
    {
        return $this->series;
    }
    
    /************************************************
     * 		METODOS
     ***********************************************/    
    
    public function __toString() {
       // return print_r($this);
        return $this->getNombre();
    }

   
}