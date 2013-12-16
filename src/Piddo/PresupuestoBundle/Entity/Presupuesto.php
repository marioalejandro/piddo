<?php

namespace Piddo\PresupuestoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     *
     * @ORM\Column(name="fecha_creacion", type="datetime")
     */
    private $fechaCreacion;
    
    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entrega", type="datetime")
     */
    private $fechaEntrega;
    
    /************************************************************************
     *      ATRIBUTOS : IDENTIFICACION DEL MOTOR                                  
     ************************************************************************/
    
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\Marca")
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\Modelo")
     */
    private $modelo;
    
    /**
     * @var string
     *
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
     * @ORM\ManyToOne(targetEntity="Piddo\ClienteBundle\Entity\Cliente")
     */
    private $cliente;
    
    /**
     * @var string
     *
     * @ORM\Column(name="RMT", type="string", length=255)
     */
    private $RMT;

    
    /************************************************************************
     *      ATRIBUTOS : TOTALES                                
     ************************************************************************/
    
    /**
     * @var integer
     *
     * @ORM\Column(name="total_repuestos", type="integer")
     */
    private $totalRepuestos;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="total_rectificados", type="integer")
     */
    private $totalRectificados;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="total_general", type="integer")
     */
    private $totalGeneral;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="descuento", type="integer")
     */
    private $descuento;
    
    /**
     * @var string
     *
     * @ORM\Column(name="motivoDescuento", type="string", length=255)
     */
    private $motivoDescuento;
    
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
     *      GETTERS & SETTERS : IDENTIFICACION DEL MOTOR                                 
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
     *      METODOS                              
     ************************************************************************/
    
    public function __toString() {
        
        return (string)$this->getId();
    }

}