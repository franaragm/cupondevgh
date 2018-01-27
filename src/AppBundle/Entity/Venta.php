<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="CuponDev_Venta")
 */
class Venta
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
     * @ORM\Column(type="datetime")
     * @Assert\Type(type="\DateTime")
     */
    protected $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Oferta")
     */
    protected $oferta;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuario")
     */
    protected $usuario;

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
     * Set fecha
     *
     * @param datetime $fecha
     *
     * @return Venta
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return datetime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set oferta
     *
     * @param Oferta $oferta
     *
     * @return Venta
     */
    public function setOferta(Oferta $oferta)
    {
        $this->oferta = $oferta;

        return $this;
    }
    /**
     * Get oferta
     *
     * @return Oferta
     */
    public function getOferta()
    {
        return $this->oferta;
    }
    /**
     * Set usuario
     *
     * @param Usuario $usuario
     *
     * @return Venta
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }
    /**
     * Get usuario
     *
     * @return Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}