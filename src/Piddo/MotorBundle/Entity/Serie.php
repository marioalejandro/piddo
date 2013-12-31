<?php

namespace Piddo\MotorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Piddo\AdminBundle\Util\Util;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Piddo\ComponenteBundle\Entity\PerfilComponente;

/**
 * Serie
 *
 * @UniqueEntity(
 *     fields={"nombre", "modelo"},
 *     errorPath="nombre",
 *     message="Esta serie ya existe en este modelo."
 * )
 * 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\MotorBundle\Entity\SerieRepository")
 */
class Serie
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
     * @Assert\NotBlank(message="Debe ingresar un nombre para la Serie")
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

    /************************************************
     * 		ATRIBUTOS FOREIGN KEY
     ***********************************************/    

    /**
     * @var string
     * @Assert\NotBlank(message="Debe elegir un modelo")
     * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\Modelo")
     */
    private $modelo;

    
    /**
     * 
     * @ORM\OneToMany(targetEntity="Piddo\ComponenteBundle\Entity\PerfilComponente", mappedBy="serie", cascade={"persist"})
     */
    private $perfilComponentes;
    
    
    /**
     * 
     * @ORM\OneToMany(targetEntity="Piddo\TallerBundle\Entity\ColRectificado", mappedBy="serie", cascade={"persist"})
     */
    private $rectDisponibles;
    
    /************************************************
     * 		CONSTRUCTOR
     ***********************************************/

    public function __construct()
    {
        $this->perfilComponentes = new \Doctrine\Common\Collections\ArrayCollection();
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

    /************************************************
     * 		GETTERS & SETTERS FOREIGN KEY 
     ***********************************************/    

    /**
     * Get marca
     *
     * @return \Piddo\MotorBundle\Entity\Marca 
     */
    public function getMarca()
    {
        return $this->modelo->getMarca();
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
     * Add perfilComponentes
     *
     * @param \Piddo\ComponenteBundle\Entity\PerfilComponente $perfilComponentes
     * @return Serie
     */
    public function addPerfilComponente(\Piddo\ComponenteBundle\Entity\PerfilComponente $perfilComponentes)
    {
        $this->perfilComponentes[] = $perfilComponentes;
    
        return $this;
    }

    /**
     * Remove perfilComponentes
     *
     * @param \Piddo\ComponenteBundle\Entity\PerfilComponente $perfilComponentes
     */
    public function removePerfilComponente(\Piddo\ComponenteBundle\Entity\PerfilComponente $perfilComponentes)
    {
        $this->perfilComponentes->removeElement($perfilComponentes);
    }

    /**
     * Get perfilComponentes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPerfilComponentes()
    {
        return $this->perfilComponentes;
    }    
    
    
    /**
     * Add rectDisponibles
     *
     * @param \Piddo\TallerBundle\Entity\ColRectificado $rectDisponibles
     * @return Serie
     */
    public function addRectDisponible(\Piddo\TallerBundle\Entity\ColRectificado $rectDisponibles)
    {
        $this->rectDisponibles[] = $rectDisponibles;
    
        return $this;
    }

    /**
     * Remove rectDisponibles
     *
     * @param \Piddo\TallerBundle\Entity\ColRectificado $rectDisponibles
     */
    public function removeRectDisponible(\Piddo\TallerBundle\Entity\ColRectificado $rectDisponibles)
    {
        $this->rectDisponibles->removeElement($rectDisponibles);
    }

    /**
     * Get rectDisponibles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRectDisponibles()
    {
        return $this->rectDisponibles;
    }

    /************************************************
     * 		METODOS
     ***********************************************/
    
    public function __toString() 
    {
        return $this->getNombre();
    }
}