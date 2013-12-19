<?php

namespace Piddo\TallerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Piddo\AdminBundle\Util\Util;

/**
 * GrupoRectificado
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\TallerBundle\Entity\GrupoRectificadoRepository")
 */
class GrupoRectificado
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
     * @ORM\OneToMany(targetEntity="Piddo\TallerBundle\Entity\Rectificado", mappedBy="grupoRectificado")
     */
    private $rectificados;
    
    
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
     * @return GrupoRectificado
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
     * @return GrupoRectificado
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
       // return print_r($this);
        return $this->getNombre();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rectificados = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add rectificados
     *
     * @param \Piddo\TallerBundle\Entity\Rectificado $rectificados
     * @return GrupoRectificado
     */
    public function addRectificado(\Piddo\TallerBundle\Entity\Rectificado $rectificados)
    {
        $this->rectificados[] = $rectificados;
    
        return $this;
    }

    /**
     * Remove rectificados
     *
     * @param \Piddo\TallerBundle\Entity\Rectificado $rectificados
     */
    public function removeRectificado(\Piddo\TallerBundle\Entity\Rectificado $rectificados)
    {
        $this->rectificados->removeElement($rectificados);
    }

    /**
     * Get rectificados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRectificados()
    {
        return $this->rectificados;
    }
}