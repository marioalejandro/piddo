<?php

namespace Piddo\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ColRectificado
 *
 * @UniqueEntity(
 *     fields={"tipoMotor", "rectificado"},
 *     errorPath="rectificado",
 *     message="Este precio ya existe en este tipo de motor."
 * )
 * 
 * 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\TallerBundle\Entity\PerfilRectificadoRepository")
 */
class Precio
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
     * @Assert\Type(type="integer", message="Solo debe ingresar números")
     * @ORM\Column(name="precio", type="integer")
     */
    private $precio;

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
     * * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\TipoMotor", inversedBy="precios", cascade={"persist"})
     */
    private $tipoMotor;

    /************************************************
     * 		CONSTRUCTOR
     ***********************************************/
    function __construct() 
    {
        $this->precio = 0;
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
     * Set precio
     *
     * @param string $precio
     * @return PerfilRectificado
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return integer
     */
    public function getPrecio()
    {
        return $this->precio;
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
     * Set tipoMotor
     *
     * @param \Piddo\MotorBundle\Entity\TipoMotor $tipoMotor
     * @return Precio
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
  
    /************************************************
     * 		METODOS
     ***********************************************/
    
    public function __toString()
    {
        return $this->getRectificado()->getNombre();
    }
  


}