<?php

namespace Piddo\ComponenteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Recepcion
 *
 * @UniqueEntity(
 *     fields={"serie", "componente"},
 *     errorPath="componente",
 *     message="Este componente ya existe en este motor."
 * ) 
 * 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\MotorBundle\Entity\RecepcionRepository")
 */
class Recepcion
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
     * 
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;

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
     * @var ColPieza
     *
     * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\ColPiezas")
     */
    private $colPieza;
    
    /**
     * @var PerfilComponente
     * @Assert\NotBlank(message="Debe tener un Perfil de Componentes")
     * @ORM\ManyToOne(targetEntity="Piddo\ComponenteBundle\Entity\PerfilComponente")
     */
    private $perfilComponente;
    

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
    
    /**
     * Set perfilComponente
     *
     * @param \Piddo\ComponenteBundle\Entity\PerfilComponente $perfilComponente
     * @return Recepcion
     */
    public function setPerfilComponente(\Piddo\ComponenteBundle\Entity\PerfilComponente $perfilComponente = null)
    {
        $this->perfilComponente = $perfilComponente;
    
        return $this;
    }

    /**
     * Get perfilComponente
     *
     * @return \Piddo\ComponenteBundle\Entity\PerfilComponente 
     */
    public function getPerfilComponente()
    {
        return $this->perfilComponente;
    }

    /************************************************
     * 		GETTERS & SETTERS EXTRAS
     ***********************************************/  
    
    public function getMaximo()
    {
        return $this->colPieza->getMaximo();
    }
    
    public function getGrupoPieza()
    {
        return $this->colPieza->getPieza()->getGrupoPieza();
    }
    
    /************************************************
     * 		METODOS
     ***********************************************/
    
    public function __toString()
    {
        return $this->getComponente()->getNombre();
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