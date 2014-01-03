<?php

namespace Piddo\TallerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Piddo\ComponenteBundle\Entity\Componente;
use Piddo\TallerBundle\Entity\Rectificado;

/**
 * ColRectificado
 *
 * @UniqueEntity(
 *     fields={"serie", "rectificado"},
 *     errorPath="rectificado",
 *     message="Este trabajo ya existe en este motor."
 * )
 * 
 * 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\TallerBundle\Entity\PerfilRectificadoRepository")
 */
class PerfilRectificado
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
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;

    /************************************************
     * 		ATRIBUTOS FOREIGN KEY
     ***********************************************/
    
    /**
     * @var string
     *
     * * @ORM\ManyToOne(targetEntity="Piddo\TallerBundle\Entity\Rectificado")
     */
    private $rectificado;

    /**
     * @var string
     *
     * * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\Serie", inversedBy="rectDisponibles")
     */
    private $serie;

    /************************************************
     * 		CONSTRUCTOR
     ***********************************************/
    function __construct() 
    {
        $this->maximo = 0;
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
     * Set cantidad
     *
     * @param string $cantidad
     * @return PerfilRectificado
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /************************************************
     * 		GETTERS EXTRAS
     ***********************************************/
    
    /**
     * Get grupoRectificado
     *
     * @return Piddo\TallerBundle\Entity\GrupoRectificado
     */
    public function getGrupoRectificado()
    {
      
        return $this->getRectificado()->getGrupoRectificado()->getNombre();
    }     

    /************************************************
     *      GETTERS & SETTERS FOREIGN KEY
     ***********************************************/    
    
    /**
     * Set rectificado
     *
     * @param string $rectificado
     * @return PerfilRectificado
     */
    public function setRectificado($rectificado)
    {
        $this->rectificado = $rectificado;
    
        return $this;
    }

    /**
     * Get rectificado
     *
     * @return string 
     */
    public function getRectificado()
    {
        return $this->rectificado;
    }

    /**
     * Set serie
     *
     * @param string $serie
     * @return PerfilRectificado
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;
    
        return $this;
    }

    /**
     * Get serie
     *
     * @return string 
     */
    public function getSerie()
    {
        return $this->serie;
    }
    /************************************************
     * 		METODOS
     ***********************************************/
    
    public function __toString()
    {
        return $this->getRectificado()->getNombre();
    }
  
}