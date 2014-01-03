<?php

namespace Piddo\MotorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Piddo\AdminBundle\Util\Util;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Piddo\MotorBundle\Entity\TipoMotor;

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
     * @Assert\NotBlank(message="Debe elegir un tipo de motor")
     * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\TipoMotor")
     */
    private $tipoMotor;

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
     * @ORM\OneToMany(targetEntity="Piddo\TallerBundle\Entity\PerfilRectificado", mappedBy="serie", cascade={"persist"})
     */
    private $perfilRectificados;
    
    /************************************************
     * 		CONSTRUCTOR
     ***********************************************/

    public function __construct()
    {
        $this->perfilComponentes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->perfilRectificados = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set tipoMotor
     *
     * @param \Piddo\MotorBundle\Entity\TipoMotor $tipoMotor
     * @return Serie
     */
    public function setTipoMotor(\Piddo\MotorBundle\Entity\TipoMotor $tipoMotor = null)
    {
        $this->tipoMotor = $tipoMotor;
    
        return $this;
    }

    /**
     * Get tipoMotor
     *
     * @return \Piddo\MotorBundle\Entity\TipoMotor 
     */
    public function getTipoMotor()
    {
        return $this->tipoMotor;
    }
    
    
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
     * Add perfilRectificados
     *
     * @param \Piddo\TallerBundle\Entity\PerfilRectificado $perfilRectificados
     * @return Serie
     */
    public function addPerfilRectificado(\Piddo\TallerBundle\Entity\PerfilRectificado $perfilRectificados)
    {
        $this->perfilRectificados[] = $perfilRectificados;
    
        return $this;
    }

    /**
     * Remove perfilRectificados
     *
     * @param \Piddo\TallerBundle\Entity\PerfilRectificado $perfilRectificados
     */
    public function removePerfilRectificado(\Piddo\TallerBundle\Entity\PerfilRectificado $perfilRectificados)
    {
        $this->perfilRectificados->removeElement($perfilRectificados);
    }

    /**
     * Get perfilRectificados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPerfilRectificados()
    {
        return $this->perfilRectificados;
    }    
    
    /************************************************
     * 		METODOS
     ***********************************************/
    
    public function __toString() 
    {
        return $this->getNombre();
    }

   


}