<?php

namespace Piddo\PresupuestoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Trabajo
 *
 * @UniqueEntity(
 *     fields={"presupuesto", "rectificado"},
 *     errorPath="rectificado",
 *     message="Este trabajo ya existe en este motor."
 * ) 
 * 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\MotorBundle\Entity\TrabajoRepository")
 */
class Trabajo
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
     * @Assert\Type(type="integer", message="Solo debe ingresar números")
     * @Assert\NotBlank(message="Debe ingresar una cantidad")
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;
    
    /**
     * @Assert\Type(type="integer", message="Solo debe ingresar números")
     * @Assert\NotBlank(message="Debe ingresar un precio")
     * @ORM\Column(name="precio", type="integer")
     */
    private $precio;

    /************************************************
     * 		ATRIBUTOS FOREIGN KEY
     ***********************************************/
    
    /**
     * @var Presupuesto
     * @Assert\NotBlank(message="Debe pertenecer a un presupuesto")
     * @ORM\ManyToOne(targetEntity="Piddo\PresupuestoBundle\Entity\Presupuesto", inversedBy="recepcionPiezas", cascade={"persist"})
     */
    private $presupuesto;
    
    /**
     * @var Rectificado
     * @Assert\NotBlank(message="Debe tener un Trabajo")
     * @ORM\ManyToOne(targetEntity="Piddo\TallerBundle\Entity\Rectificado")
     */
    private $rectificado;
    /************************************************
     * 		CONSTRUCTOR
     ***********************************************/ 
    function __construct() 
    {
        $this->cantidad = 0;
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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Recepcion
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }
    
    /**
     * Set precio
     *
     * @param integer $precio
     * @return Trabajo
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
     * 		GETTERS & SETTERS FOREIGN KEY
     ***********************************************/  

    /**
     * Set presupuesto
     *
     * @param \Piddo\PresupuestoBundle\Entity\Presupuesto $presupuesto
     * @return Recepcion
     */
    public function setPresupuesto(\Piddo\PresupuestoBundle\Entity\Presupuesto $presupuesto = null)
    {
        $this->presupuesto = $presupuesto;
    
        return $this;
    }

    /**
     * Get presupuesto
     *
     * @return \Piddo\PresupuestoBundle\Entity\Presupuesto 
     */
    public function getPresupuesto()
    {
        return $this->presupuesto;
    }

    /**
     * Set rectificado
     *
     * @param \Piddo\TallerBundle\Entity\Rectificado $rectificado
     * @return Trabajo
     */
    public function setRectificado(\Piddo\TallerBundle\Entity\Rectificado $rectificado = null)
    {
        $this->rectificado = $rectificado;
    
        return $this;
    }

    /**
     * Get rectificado
     *
     * @return \Piddo\TallerBundle\Entity\Rectificado 
     */
    public function getRectificado()
    {
        return $this->rectificado;
    }
    


    /************************************************
     * 		GETTERS & SETTERS EXTRAS
     ***********************************************/  

    
    /**
     * Get GrupoRectificado
     *
     * @return \Piddo\ComponenteBundle\Entity\GrupoRectificado
     */
    public function getGrupoRectificado()
    {
        return $this->getRectificado()->getGrupoRectificado()->getNombre();
    }
    
    /************************************************
     * 		METODOS
     ***********************************************/
    
    public function __toString()
    {
        return $this->getRectificado()->getNombre();
    }    
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('cantidad', new Assert\Range(array(
            'min'        => 0,
            'max'        => 3,
            'minMessage' => 'Vous devez faire au moins 120cm pour entrer',
            'maxMessage' => 'Vous ne devez pas dépasser 180cm',
        )));
    }





}