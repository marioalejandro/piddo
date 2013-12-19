<?php

namespace Piddo\TallerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ColRectificado
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Piddo\TallerBundle\Entity\ColRectificadoRepository")
 */
class ColRectificado
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
     * * @ORM\ManyToOne(targetEntity="Piddo\TallerBundle\Entity\Rectificado")
     */
    private $rectificado;

    /**
     * @var string
     *
     * * @ORM\ManyToOne(targetEntity="Piddo\MotorBundle\Entity\Serie", inversedBy="rectDisponibles")
     */
    private $serie;

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
     * Set rectificado
     *
     * @param string $rectificado
     * @return ColRectificado
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
     * Set serie
     *
     * @param string $serie
     * @return ColRectificado
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
     * Set cantidad
     *
     * @param string $cantidad
     * @return ColRectificado
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }
}