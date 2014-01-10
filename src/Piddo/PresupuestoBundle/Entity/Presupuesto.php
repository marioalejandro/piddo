<?php

namespace Piddo\PresupuestoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Presupuesto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Presupuesto
{
    /************************************************************************
     *      ATRIBUTOS : IDENTIFICACION DEL PRESUPUESTO                                  
     ************************************************************************/
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Debe ingresar una fecha")
     * @ORM\Column(name="fecha_creacion", type="datetime")
     */
    private $fechaCreacion;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Debe elegir un estado")
     * @ORM\Column(name="estado", type="string", length=255)
     */
    private $estado;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Debe ingresar una fecha de entrega")
     * @ORM\Column(name="fecha_entrega", type="datetime")
     */
    private $fechaEntrega;
    
    /************************************************************************
     *      ATRIBUTOS : IDENTIFICACION DEL MOTOR                                  
     ************************************************************************/
    
    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\Marca")
     */
    private $marca;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\Modelo")
     */
    private $modelo;
    
    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\Serie")
     */
    private $serie;

    /**
     * @var string
     * 
     * @ORM\Column(name="numMotor", type="string", length=100, nullable=true)
     */
    private $numMotor;
    
    /************************************************************************
     *      ATRIBUTOS : OBJETOS INVOLUCRADOS                                
     ************************************************************************/
    
    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Piddo\ClienteBundle\Entity\Cliente")
     */
    private $cliente;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="RMT", type="string", length=255, nullable=true)
     */
    private $RMT;
  
    /**
     * 
     * @ORM\OneToMany(targetEntity="Piddo\PresupuestoBundle\Entity\Recepcion", mappedBy="presupuesto", cascade={"persist"})
     */
    protected $recepcionComponentes;
    
    /**
     * 
     * @ORM\OneToMany(targetEntity="Piddo\PresupuestoBundle\Entity\Trabajo", mappedBy="presupuesto", cascade={"persist"})
     */
    protected $trabajos;
    
    /************************************************************************
     *      ATRIBUTOS : TOTALES                                
     ************************************************************************/
    
    /**
     * @var integer
     * @Assert\Type(type="integer", message="Solo debe ingresar números")
     * @ORM\Column(name="total_repuestos", type="integer")
     */
    private $totalRepuestos;
    
    /**
     * @var integer
     * @Assert\Type(type="integer", message="Solo debe ingresar números")
     * @ORM\Column(name="total_rectificados", type="integer")
     */
    private $totalRectificados;
    
    /**
     * @var integer
     * @Assert\Type(type="integer", message="Solo debe ingresar números")
     * @ORM\Column(name="total_general", type="integer")
     */
    private $totalGeneral;
    
    /**
     * @var integer
     * @Assert\Type(type="integer", message="Solo debe ingresar números")
     * @ORM\Column(name="descuento", type="integer")
     */
    private $descuento;
    /**
     * @var integer
     * @Assert\Type(type="integer", message="Solo debe ingresar números")
     * @ORM\Column(name="pagado", type="integer")
     */
    private $pagado;
    
    /**
     * @var string
     * @ORM\Column(name="motivoDescuento", type="string", length=255)
     */
    private $motivoDescuento;

    /************************************************************************
     *      CONSTRUCTOR                              
     ************************************************************************/    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recepcionComponentes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->trabajos = new \Doctrine\Common\Collections\ArrayCollection();
        //Valores por defecto
        $this->setDescuento(0);
        $this->setTotalGeneral(0);
        $this->setTotalRectificados(0);
        $this->setTotalRepuestos(0);
        $this->setMotivoDescuento('');
        $this->setPagado(0);
        
        $this->setFechaCreacion(new \DateTime('now'));
        $this->setFechaEntrega(new \DateTime('tomorrow'));
        $this->setEstado('PENDIENTE');
    }
    
    
    
    /************************************************************************
     *      GETTERS & SETTERS : IDENTIFICACION DEL PRESUPUESTO                                  
     ************************************************************************/


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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Presupuesto
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    
        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Presupuesto
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fechaEntrega
     *
     * @param \DateTime $fechaEntrega
     * @return Presupuesto
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;
    
        return $this;
    }

    /**
     * Get fechaEntrega
     *
     * @return \DateTime 
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }

    /************************************************************************
     *      GETTERS & SETTERS : IDENTIFICACION DEL MOTOR                    *            
     ************************************************************************/
    
    /**
     * Set marca
     *
     * @param string $marca
     * @return Presupuesto
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    
        return $this;
    }

    /**
     * Get marca
     *
     * @return string 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set modelo
     *
     * @param string $modelo
     * @return Presupuesto
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    
        return $this;
    }

    /**
     * Get modelo
     *
     * @return string 
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set serie
     *
     * @param string $serie
     * @return Presupuesto
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

    /**
     * Set numMotor
     *
     * @param string $numMotor
     * @return Presupuesto
     */
    public function setNumMotor($numMotor)
    {
        $this->numMotor = $numMotor;
    
        return $this;
    }

    /**
     * Get numMotor
     *
     * @return string 
     */
    public function getNumMotor()
    {
        return $this->numMotor;
    }
    
    /************************************************************************
     *      GETTERS & SETTERS : IDENTIFICACION DEL CLIENTE                                 
     ************************************************************************/
    
    /**
     * Set cliente
     *
     * @param \Piddo\ClienteBundle\Entity\Cliente $cliente
     * @return Presupuesto
     */
    public function setCliente(\Piddo\ClienteBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;
    
        return $this;
    }

    /**
     * Get cliente
     *
     * @return \Piddo\ClienteBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set RMT
     *
     * @param string $rMT
     * @return Presupuesto
     */
    public function setRMT($rMT)
    {
        $this->RMT = $rMT;
    
        return $this;
    }

    /**
     * Get RMT
     *
     * @return string 
     */
    public function getRMT()
    {
        return $this->RMT;
    }

    
    /************************************************************************
     *      GETTERS & SETTERS : TOTALES                               
     ************************************************************************/
    
    /**
     * Set totalRepuestos
     *
     * @param integer $totalRepuestos
     * @return Presupuesto
     */
    public function setTotalRepuestos($totalRepuestos)
    {
        $this->totalRepuestos = $totalRepuestos;
    
        return $this;
    }

    /**
     * Get totalRepuestos
     *
     * @return integer 
     */
    public function getTotalRepuestos()
    {
        return $this->totalRepuestos;
    }

    /**
     * Set totalRectificados
     *
     * @param integer $totalRectificados
     * @return Presupuesto
     */
    public function setTotalRectificados($totalRectificados)
    {
        $this->totalRectificados = $totalRectificados;
    
        return $this;
    }

    /**
     * Get totalRectificados
     *
     * @return integer 
     */
    public function getTotalRectificados()
    {
        return $this->totalRectificados;
    }

    /**
     * Set totalGeneral
     *
     * @param integer $totalGeneral
     * @return Presupuesto
     */
    public function setTotalGeneral($totalGeneral)
    {
        $this->totalGeneral = $totalGeneral;
    
        return $this;
    }

    /**
     * Get totalGeneral
     *
     * @return integer 
     */
    public function getTotalGeneral()
    {
        return $this->totalGeneral;
    }

    /**
     * Set descuento
     *
     * @param integer $descuento
     * @return Presupuesto
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    
        return $this;
    }

    /**
     * Get descuento
     *
     * @return integer 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }
    
    
    /**
     * Set pagado
     *
     * @param integer $pagado
     * @return Presupuesto
     */
    public function setPagado($pagado)
    {
        $this->pagado = $pagado;
    
        return $this;
    }

    /**
     * Get pagado
     *
     * @return integer 
     */
    public function getPagado()
    {
        return $this->pagado;
    }

    /**
     * Set motivoDescuento
     *
     * @param string $motivoDescuento
     * @return Presupuesto
     */
    public function setMotivoDescuento($motivoDescuento)
    {
        $this->motivoDescuento = $motivoDescuento;
    
        return $this;
    }
    

    /**
     * Get motivoDescuento
     *
     * @return string 
     */
    public function getMotivoDescuento()
    {
        return $this->motivoDescuento;
    }
     /************************************************************************
     *      GETTERS & SETTERS : FOREIGN KEY                             
     ************************************************************************/
    
    /**
     * Add recepcionComponentes
     *
     * @param \Piddo\PresupuestoBundle\Entity\Recepcion $recepcionComponentes
     * @return Presupuesto
     */
    public function addRecepcionComponente(\Piddo\PresupuestoBundle\Entity\Recepcion $recepcionComponentes)
    {
        $this->recepcionComponentes[] = $recepcionComponentes;
    
        return $this;
    }

    /**
     * Remove recepcionComponentes
     *
     * @param \Piddo\PresupuestoBundle\Entity\Recepcion $recepcionComponentes
     */
    public function removeRecepcionComponente(\Piddo\PresupuestoBundle\Entity\Recepcion $recepcionComponentes)
    {
        $this->recepcionComponentes->removeElement($recepcionComponentes);
    }

    /**
     * Get recepcionComponentes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecepcionComponentes()
    {
        return $this->recepcionComponentes;
    }    
     /**
     * Add trabajos
     *
     * @param \Piddo\PresupuestoBundle\Entity\Trabajo $trabajos
     * @return Presupuesto
     */
    public function addTrabajo(\Piddo\PresupuestoBundle\Entity\Trabajo $trabajos)
    {
        $this->trabajos[] = $trabajos;
    
        return $this;
    }

    /**
     * Remove trabajos
     *
     * @param \Piddo\PresupuestoBundle\Entity\Trabajo $trabajos
     */
    public function removeTrabajo(\Piddo\PresupuestoBundle\Entity\Trabajo $trabajos)
    {
        $this->trabajos->removeElement($trabajos);
    }

    /**
     * Get trabajos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTrabajos()
    {
        return $this->trabajos;
    }

    /************************************************************************
     *      METODOS                              
     ************************************************************************/
    
    public function __toString() {
        
        return (string)$this->getId();
    }







}