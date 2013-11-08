<?php

namespace Piddo\TallerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Piddo\AdminBundle\Util\Util;

/**
 * Rectificado
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\TallerBundle\Entity\RectificadoRepository")
 */
class Rectificado
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
     * @ORM\ManyToOne(targetEntity="Piddo\TallerBundle\Entity\GrupoRectificado")
     */
    private $grupoRectificado;


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
     * @return Rectificado
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
     * @return Rectificado
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
     * Set grupoRectificado
     *
     * @param \Piddo\TallerBundle\Entity\GrupoRectificado $grupoRectificado
     * @return Rectificado
     */
    public function setGrupoRectificado(\Piddo\TallerBundle\Entity\GrupoRectificado $grupoRectificado = null)
    {
        $this->grupoRectificado = $grupoRectificado;
    
        return $this;
    }

    /**
     * Get grupoRectificado
     *
     * @return \Piddo\TallerBundle\Entity\GrupoRectificado 
     */
    public function getGrupoRectificado()
    {
        return $this->grupoRectificado;
    }
}