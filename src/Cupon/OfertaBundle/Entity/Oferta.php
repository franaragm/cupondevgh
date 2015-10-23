<?php

namespace Cupon\OfertaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cupon\OfertaBundle\Util\Util;

/**
 * Oferta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Oferta
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="condiciones", type="text")
     */
    private $condiciones;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_foto", type="string", length=255)
     */
    private $rutaFoto;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="decimal")
     */
    private $precio;

    /**
     * @var string
     *
     * @ORM\Column(name="descuento", type="decimal")
     */
    private $descuento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_publicacion", type="datetime")
     */
    private $fechaPublicacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_expiracion", type="datetime")
     */
    private $fechaExpiracion;

    /**
     * @var integer
     *
     * @ORM\Column(name="compras", type="integer")
     */
    private $compras;

    /**
     * @var integer
     *
     * @ORM\Column(name="umbral", type="integer")
     */
    private $umbral;

    /**
     * @var boolean
     *
     * @ORM\Column(name="revisada", type="boolean")
     */
    private $revisada;

    /**
     * @ORM\ManyToOne(targetEntity="Cupon\CiudadBundle\Entity\Ciudad")
     */
    private $ciudad;

    /**
     * @ORM\ManyToOne(targetEntity="Cupon\TiendaBundle\Entity\Tienda")
     */
    private $tienda;

    public function __toString()
    {
        return $this->getNombre();
    }

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Oferta
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        $this->slug = Util::getSlug($nombre);

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Oferta
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Oferta
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set condiciones
     *
     * @param string $condiciones
     *
     * @return Oferta
     */
    public function setCondiciones($condiciones)
    {
        $this->condiciones = $condiciones;

        return $this;
    }

    /**
     * Get condiciones
     *
     * @return string
     */
    public function getCondiciones()
    {
        return $this->condiciones;
    }

    /**
     * Set rutaFoto
     *
     * @param string $rutaFoto
     *
     * @return Oferta
     */
    public function setRutaFoto($rutaFoto)
    {
        $this->rutaFoto = $rutaFoto;

        return $this;
    }

    /**
     * Get rutaFoto
     *
     * @return string
     */
    public function getRutaFoto()
    {
        return $this->rutaFoto;
    }

    /**
     * Set precio
     *
     * @param string $precio
     *
     * @return Oferta
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set descuento
     *
     * @param string $descuento
     *
     * @return Oferta
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get descuento
     *
     * @return string
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set fechaPublicacion
     *
     * @param \DateTime $fechaPublicacion
     *
     * @return Oferta
     */
    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }

    /**
     * Get fechaPublicacion
     *
     * @return \DateTime
     */
    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }

    /**
     * Set fechaExpiracion
     *
     * @param \DateTime $fechaExpiracion
     *
     * @return Oferta
     */
    public function setFechaExpiracion($fechaExpiracion)
    {
        $this->fechaExpiracion = $fechaExpiracion;

        return $this;
    }

    /**
     * Get fechaExpiracion
     *
     * @return \DateTime
     */
    public function getFechaExpiracion()
    {
        return $this->fechaExpiracion;
    }

    /**
     * Set compras
     *
     * @param integer $compras
     *
     * @return Oferta
     */
    public function setCompras($compras)
    {
        $this->compras = $compras;

        return $this;
    }

    /**
     * Get compras
     *
     * @return integer
     */
    public function getCompras()
    {
        return $this->compras;
    }

    /**
     * Set umbral
     *
     * @param integer $umbral
     *
     * @return Oferta
     */
    public function setUmbral($umbral)
    {
        $this->umbral = $umbral;

        return $this;
    }

    /**
     * Get umbral
     *
     * @return integer
     */
    public function getUmbral()
    {
        return $this->umbral;
    }

    /**
     * Set revisada
     *
     * @param boolean $revisada
     *
     * @return Oferta
     */
    public function setRevisada($revisada)
    {
        $this->revisada = $revisada;

        return $this;
    }

    /**
     * Get revisada
     *
     * @return boolean
     */
    public function getRevisada()
    {
        return $this->revisada;
    }

    /**
     * Set ciudad
     *
     * @param Cupon\CiudadBundle\Entity\Ciudad $ciudad
     *
     * @return Oferta
     */
    public function setCiudad(\Cupon\CiudadBundle\Entity\Ciudad $ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return Cupon\CiudadBundle\Entity\Ciudad
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set tienda
     *
     * @param Cupon\TiendaBundle\Entity\Tienda $tienda
     *
     * @return Oferta
     */
    public function setTienda(\Cupon\TiendaBundle\Entity\Tienda $tienda)
    {
        $this->tienda = $tienda;

        return $this;
    }

    /**
     * Get tienda
     *
     * @return Cupon\TiendaBundle\Entity\Tienda
     */
    public function getTienda()
    {
        return $this->tienda;
    }
}

