<?php

namespace Piddo\MotorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ColPiezas
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ColPiezas
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
     * * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\Serie", inversedBy="piezasDisponibles")
     */
    private $serie;

    /**
     * @var string
     *
     * * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\Pieza")
     */
    private $pieza;

    /**
     * @var integer
     *
     * @ORM\Column(name="maximo", type="integer")
     */
    private $maximo;


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
     * Set maximo
     *
     * @param integer $maximo
     * @return ColPiezas
     */
    public function setMaximo($maximo)
    {
        $this->maximo = $maximo;
    
        return $this;
    }

    /**
     * Get maximo
     *
     * @return integer 
     */
    public function getMaximo()
    {
        return $this->maximo;
    }

    /**
     * Set serie
     *
     * @param \Piddo\MotorBundle\Entity\Serie $serie
     * @return ColPiezas
     */
    public function setSerie(\Piddo\MotorBundle\Entity\Serie $serie = null)
    {
        $this->serie = $serie;
    
        return $this;
    }

    /**
     * Get serie
     *
     * @return \Piddo\MotorBundle\Entity\Serie 
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set pieza
     *
     * @param \Piddo\MotorBundle\Entity\Pieza $pieza
     * @return ColPiezas
     */
    public function setPieza(\Piddo\MotorBundle\Entity\Pieza $pieza = null)
    {
        $this->pieza = $pieza;
    
        return $this;
    }

    /**
     * Get pieza
     *
     * @return \Piddo\MotorBundle\Entity\Pieza 
     */
    public function getPieza()
    {
        return $this->pieza;
    }
    /************************************************************************
     *      METODOS                              
     ************************************************************************/
    
    public function __toString() {
        
        return $this->getPieza()->getNombre();
    }
}