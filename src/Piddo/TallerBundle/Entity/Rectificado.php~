<?php

namespace Piddo\TallerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Piddo\AdminBundle\Util\Util;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Piddo\TallerBundle\Entity\GrupoRectificado;

/**
 * Rectificado
 *
  * @UniqueEntity(
 *     fields={"nombre", "grupoRectificado"},
 *     errorPath="nombre",
 *     message="Este trabajo ya existe en este grupo."
 * )
 * 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\TallerBundle\Entity\RectificadoRepository")
 */
class Rectificado
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
     * @Assert\NotBlank(message="Debe ingresar un nombre para el trabajo")
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
     * @Assert\NotBlank(message="Primero crea un grupo")
     * @ORM\ManyToOne(targetEntity="Piddo\TallerBundle\Entity\GrupoRectificado")
     */
    private $grupoRectificado;
    
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
    /************************************************
     *      GETTERS & SETTERS FOREIGN KEY
     ***********************************************/


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
    
    /************************************************
     * 		METODOS
     ***********************************************/    
    public function __toString() 
    {
        return $this->getNombre();
    }
}