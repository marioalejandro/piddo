<?php

namespace Piddo\PresupuestoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Recepcion
 *
 * @UniqueEntity(
 *     fields={"presupuesto", "perfilComponente"},
 *     errorPath="perfilComponente",
 *     message="Este componente ya se ingresó en este motor."
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
     * @Assert\NotBlank(message="Debe ingresar una cantidad")
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
     * @var PerfilComponente
     * @Assert\NotBlank(message="Debe tener un Perfil de Componentes")
     * @ORM\ManyToOne(targetEntity="Piddo\ComponenteBundle\Entity\PerfilComponente")
     */
    private $perfilComponente;
    /************************************************
     * 		CONSTRUCTOR
     ***********************************************/ 
    function __construct() 
    {
        $this->cantidad = 0;
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
    /**
     * Get maximo
     *
     * @return integer 
     */
    public function getMaximo()
    {
        return $this->perfilComponente->getMaximo();
    }
    
    /**
     * Get GrupoComponente
     *
     * @return \Piddo\ComponenteBundle\Entity\GrupoComponente
     */
    public function getGrupoComponente()
    {
        return $this->getPerfilComponente()->getComponente()->getGrupoComponente()->getNombre();
    }
    /**
     * Get GrupoComponente
     *
     * @return \Piddo\ComponenteBundle\Entity\GrupoComponente
     */
    public function getComponente()
    {
        return $this->getPerfilComponente()->getComponente()->getNombre();
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