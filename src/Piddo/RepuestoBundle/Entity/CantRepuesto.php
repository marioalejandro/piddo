<?php

namespace Piddo\RepuestoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CantRepuesto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\RepuestoBundle\Entity\CantRepuestoRepository")
 */
class CantRepuesto
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
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Piddo\RepuestoBundle\Entity\Repuesto")
     */
    private $repuesto;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Piddo\PresupuestoBundle\Entity\Presupuesto")
     */
    private $presupuesto;

    /**
     * @var integer
     *
     * @ORM\Column(name="precio", type="integer")
     */
    private $precio;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;


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
     * Set motor
     *
     * @param integer $motor
     * @return CantRepuesto
     */
    public function setMotor($motor)
    {
        $this->motor = $motor;
    
        return $this;
    }

    /**
     * Get motor
     *
     * @return integer 
     */
    public function getMotor()
    {
        return $this->motor;
    }

    /**
     * Set repuesto
     *
     * @param integer $repuesto
     * @return CantRepuesto
     */
    public function setRepuesto($repuesto)
    {
        $this->repuesto = $repuesto;
    
        return $this;
    }

    /**
     * Get repuesto
     *
     * @return integer 
     */
    public function getRepuesto()
    {
        return $this->repuesto;
    }

    /**
     * Set presupuesto
     *
     * @param integer $presupuesto
     * @return CantRepuesto
     */
    public function setPresupuesto($presupuesto)
    {
        $this->presupuesto = $presupuesto;
    
        return $this;
    }

    /**
     * Get presupuesto
     *
     * @return integer 
     */
    public function getPresupuesto()
    {
        return $this->presupuesto;
    }

    /**
     * Set precio
     *
     * @param integer $precio
     * @return CantRepuesto
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

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return CantRepuesto
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
}
