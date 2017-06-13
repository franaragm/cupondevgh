<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Util\Slugger;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TiendaRepository")
 * @ORM\Table(name="CuponDev_Tienda")
 */
class Tienda implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $login;

    private $passwordEnClaro;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $password;

    /**
     * @ORM\Column(type="text")
     */
    protected $descripcion;

    /**
     * @ORM\Column(type="text")
     */
    protected $direccion;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ciudad")
     */
    protected $ciudad;

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
     * @return Tienda
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
     * @return Tienda
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
     * Set login
     *
     * @param string $login
     *
     * @return Tienda
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param $password
     * @return $this
     */
    public function setPasswordEnClaro($password)
    {
        $this->passwordEnClaro = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPasswordEnClaro()
    {
        return $this->passwordEnClaro;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Tienda
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Tienda
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
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Tienda
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set ciudad
     *
     * @param Ciudad $ciudad
     *
     * @return Tienda
     */
    public function setCiudad(Ciudad $ciudad = null)
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
     * Método requerido por la interfaz UserInterface.
     *
     * @return array
     */
    public function getRoles()
    {
        return array('ROLE_TIENDA');
    }

    /**
     * Método requerido por la interfaz UserInterface.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->getLogin();
    }

    /**
     * Método requerido por la interfaz UserInterface.
     */
    public function eraseCredentials()
    {
        $this->passwordEnClaro = null;
    }
    /**
     * Este método es requerido por la interfaz UserInterface, pero esta clase
     * no necesita implementarlo porque se usa 'bcrypt' para codificar las contraseñas.
     */
    public function getSalt() { }

}
