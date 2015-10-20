<?php

namespace Cupon\OfertaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Venta
{
    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Cupon\OfertaBundle\Entity\Oferta")
     */
    protected $oferta;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Cupon\UsuarioBundle\Entity\Usuario")
     */
    protected $usuario;

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
     * @param Cupon\OfertaBundle\Entity\Oferta $oferta
     *
     * @return Venta
     */
    public function setOferta(\Cupon\OfertaBundle\Entity\Oferta $oferta)
    {
        $this->oferta = $oferta;

        return $this;
    }
    /**
     * Get oferta
     *
     * @return Cupon\OfertaBundle\Entity\Oferta
     */
    public function getOferta()
    {
        return $this->oferta;
    }
    /**
     * Set usuario
     *
     * @param Cupon\UsuarioBundle\Entity\Usuario $usuario
     *
     * @return Venta
     */
    public function setUsuario(\Cupon\UsuarioBundle\Entity\Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }
    /**
     * Get usuario
     *
     * @return Cupon\UsuarioBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}