<?php

namespace Piddo\MotorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Recepcion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\MotorBundle\Entity\RecepcionRepository")
 */
class Recepcion
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
     * @ORM\ManyToOne(targetEntity="Piddo\PresupuestoBundle\Entity\Presupuesto", inversedBy="recepcionPiezas", cascade={"persist"})
     */
    private $presupuesto;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\ColPiezas")
     */
    private $colPieza;

    /**

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
     * Set colPieza
     *
     * @param \Piddo\MotorBundle\Entity\ColPiezas $colPieza
     * @return Recepcion
     */
    public function setColPieza(\Piddo\MotorBundle\Entity\ColPiezas $colPieza = null)
    {
        $this->colPieza = $colPieza;
    
        return $this;
    }

    /**
     * Get colPieza
     *
     * @return \Piddo\MotorBundle\Entity\ColPiezas 
     */
    public function getColPieza()
    {
        return $this->colPieza;
    }
    /**
     * Get maximo
     *
     * @return integer 
     */
    public function getMaximo()
    {
        return $this->colPieza->getMaximo();
    }
    
    public function getGrupoPieza()
    {
        return $this->colPieza->getPieza()->getGrupoPieza();
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