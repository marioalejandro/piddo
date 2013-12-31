<?php

namespace Piddo\ComponenteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Piddo\AdminBundle\Util\Util;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Piddo\ComponenteBundle\Entity\Componente;

/**
 * GrupoComponente
 *
 * @ORM\Table()
 * 
 * @UniqueEntity(
 *     fields="nombre",
 *     message="Este grupo ya existe."
 * )
 * 
 * @ORM\Entity(repositoryClass="Piddo\ComponenteBundle\Entity\GrupoComponenteRepository")
 */
class GrupoComponente
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
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
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
     * @var Componente[]
     * 
     * @Assert\NotBlank(message="Debe escojer un componente")
     * 
     * @ORM\OneToMany(targetEntity="Componente", mappedBy="grupoComponente")
     */
    private $componentes;

    /************************************************
     * 		CONSTRUCTOR
     ***********************************************/    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->componentes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return GrupoComponente
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
     * @return GrupoComponente
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
     * Add componentes
     *
     * @param \Piddo\ComponenteBundle\Entity\Componente $componentes
     * @return GrupoComponente
     */
    public function addComponente(\Piddo\ComponenteBundle\Entity\Componente $componentes)
    {
        $this->componentes[] = $componentes;
    
        return $this;
    }

    /**
     * Remove componentes
     *
     * @param \Piddo\ComponenteBundle\Entity\Componente $componentes
     */
    public function removeComponente(\Piddo\ComponenteBundle\Entity\Componente $componentes)
    {
        $this->componentes->removeElement($componentes);
    }

    /**
     * Get componentes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComponentes()
    {
        return $this->componentes;
    }    
    
    
    /************************************************
     * 		METODOS
     ***********************************************/
	
    public function __toString() 
    {
        return $this->getNombre();
    }
    
}