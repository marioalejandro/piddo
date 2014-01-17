<?php

namespace Piddo\RepuestoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Repuestos
 *
 * @UniqueEntity(
 *     fields={"presupuesto", "repuesto"},
 *     errorPath="repuesto",
 *     message="Ya se ingresó este repuesto."
 * ) 
 * 
 * @ORM\Table()
 * @ORM\Entity()
 */
class Repuestos
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
     * @ORM\ManyToOne(targetEntity="Piddo\PresupuestoBundle\Entity\Presupuesto", inversedBy="repuestos", cascade={"persist"})
     */
    private $presupuesto;
    
    /**
     * @var Rectificado
     * @Assert\NotBlank(message="Debe tener un repuesto asignado")
     * @ORM\ManyToOne(targetEntity="Piddo\RepuestoBundle\Entity\Repuesto")
     */
    private $repuesto;
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
     * Set repuesto
     *
     * @param \Piddo\RepuestoBundle\Entity\Repuesto $repuesto
     * @return Repuestos
     */
    public function setRepuesto(\Piddo\RepuestoBundle\Entity\Repuesto $repuesto = null)
    {
        $this->repuesto = $repuesto;
    
        return $this;
    }

    /**
     * Get repuesto
     *
     * @return \Piddo\RepuestoBundle\Entity\Repuesto 
     */
    public function getRepuesto()
    {
        return $this->repuesto;
    }


    /************************************************
     * 		GETTERS & SETTERS EXTRAS
     ***********************************************/  

    
   
    
    /************************************************
     * 		METODOS
     ***********************************************/
    
    public function __toString()
    {
        return $this->getRectificado()->getNombre();
    }    
    








}