<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Util\Slugger;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OfertaRepository")
 * @ORM\Table(name="CuponDev_Oferta")
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
     *
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     *
     * @Assert\NotBlank()
     * @Assert\Length(min = 30)
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
     * @ORM\Column(name="oferta_foto", type="string", length=255)
     */
    private $ofertaFoto;


    /**
     * @Assert\Image(
     *     maxSize = "500k",
     *     mimeTypes = {
     *          "image/png",
     *          "image/jpeg",
     *          "image/jpg"
     *      }
     * )
     */
    private $fotoTemp;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="decimal", scale=2)
     *
     * @Assert\Range(min = 0)
     */
    private $precio;

    /**
     * @var string
     *
     * @ORM\Column(name="descuento", type="decimal", scale=2)
     */
    private $descuento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_publicacion", type="datetime", nullable=true)
     *
     * @Assert\DateTime
     */
    private $fechaPublicacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_expiracion", type="datetime", nullable=true)
     *
     * @Assert\DateTime
     */
    private $fechaExpiracion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="datetime", nullable=true)
     *
     * @Assert\DateTime
     */
    private $fechaActualizacion;

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
     *
     * @Assert\Range(min = 0)
     */
    private $umbral;

    /**
     * @var boolean
     *
     * @ORM\Column(name="revisada", type="boolean")
     *
     * @Assert\Type(type="bool")
     */
    private $revisada;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ciudad")
     */
    private $ciudad;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tienda")
     */
    private $tienda;

    public function __toString()
    {
        return $this->getNombre();
    }

    public function __construct()
    {
        $this->compras = 0;
        $this->revisada = false;
        $this->fechaActualizacion = new \Datetime();
    }

    /**
     * Este método estático actúa como "constructor con nombre" y simplifica el
     * código de la aplicación ya que rellena los campos de la oferta que no
     * puede rellenar la tienda que ha creado la oferta.
     *
     * @param Tienda $tienda
     *
     * @return Oferta
     */
    public static function crearParaTienda(Tienda $tienda)
    {
        $oferta = new self();
        $oferta->setTienda($tienda);
        $oferta->setCiudad($tienda->getCiudad());
        return $oferta;
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
        $this->slug = Slugger::getSlug($nombre);

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
     * Set ofertaFoto
     *
     * @param string $ofertaFoto
     *
     * @return Oferta
     */
    public function setOfertaFoto($ofertaFoto)
    {
        $this->ofertaFoto = $ofertaFoto;

        return $this;
    }

    /**
     * Get ofertaFoto
     *
     * @return string
     */
    public function getOfertaFoto()
    {
        return $this->ofertaFoto;
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
     * @param \DateTime $fechaActualizacion
     *
     * @return Oferta
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
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
     * @param Ciudad $ciudad
     * @return Oferta
     */
    public function setCiudad(Ciudad $ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return Ciudad
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set tienda
     *
     * @param Tienda $tienda
     * @return Oferta
     */
    public function setTienda(Tienda $tienda)
    {
        $this->tienda = $tienda;

        return $this;
    }

    /**
     * Get tienda
     *
     * @return Tienda
     */
    public function getTienda()
    {
        return $this->tienda;
    }

    /**
     * @Assert\IsTrue(message = "La fecha de expiración debe ser posterior a la fecha de publicación")
     */
    public function isFechaValida()
    {
        if (null === $this->fechaPublicacion || null === $this->fechaExpiracion) {
            return true;
        }
        return $this->fechaExpiracion > $this->fechaPublicacion;
    }

    /**
     * @return UploadedFile
     */
    public function getFotoTemp()
    {
        return $this->fotoTemp;
    }

    /**
     * @param UploadedFile $foto
     */
    public function setFotoTemp(UploadedFile $foto = null)
    {
        $this->fotoTemp = $foto;

        // para que el "listener" de Doctrine guarde bien los cambios, al menos
        // una propiedad debe cambiar su valor (además de la propiedad de la foto)
        if (null !== $foto) {
            $this->fechaActualizacion = new \Datetime('now');
        }
    }

    public function subirFoto($directorioDestino)
    {
        if (null === $this->fotoTemp) {
            return;
        }

        $nombreArchivoFoto = uniqid('cupon-').'-foto1.jpg';
        $this->fotoTemp->move($directorioDestino, $nombreArchivoFoto);
        $this->setOfertaFoto($nombreArchivoFoto);
    }
}

