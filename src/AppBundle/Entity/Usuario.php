<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Util\Slugger;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 * @ORM\Table(name="CuponDev_Usuario")
 * @DoctrineAssert\UniqueEntity("email")
 */
class Usuario implements UserInterface
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
     * @ORM\Column(name="nombre", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * No es columna de base de datos, solo variable para validar datos de formulario
     * @var string
     *
     * @Assert\NotBlank(groups={"registro"})
     * @Assert\Length(min = 6)
     */
    private $passwordEnClaro;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="text")
     * @Assert\NotBlank()
     */
    private $direccion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="permite_email", type="boolean")
     * @Assert\Type(type="bool")
     */
    private $permiteEmail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_alta", type="datetime")
     * @Assert\DateTime()
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="datetime")
     * @Assert\DateTime()
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=9)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_tarjeta", type="string", length=20)
     * @Assert\CardScheme(schemes={"AMEX", "MAESTRO", "MASTERCARD", "VISA"})
     */
    private $numeroTarjeta;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ciudad")
     * @Assert\Type("AppBundle\Entity\Ciudad")
     */
    private $ciudad;

    public function __construct()
    {
        $this->fechaAlta = new \DateTime();
        $this->permiteEmail = true;
    }

    public function __toString()
    {
        return $this->getNombre() . ' ' . $this->getApellidos();
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
     * @return Usuario
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
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Usuario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

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
     * @param mixed $password
     */
    public function setPasswordEnClaro($password)
    {
        $this->passwordEnClaro = $password;
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
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Usuario
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
     * Set permiteEmail
     *
     * @param boolean $permiteEmail
     *
     * @return Usuario
     */
    public function setPermiteEmail($permiteEmail)
    {
        $this->permiteEmail = $permiteEmail;

        return $this;
    }

    /**
     * Get permiteEmail
     *
     * @return boolean
     */
    public function getPermiteEmail()
    {
        return $this->permiteEmail;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return Usuario
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Usuario
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set dni
     *
     * @param string $dni
     *
     * @return Usuario
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set numeroTarjeta
     *
     * @param string $numeroTarjeta
     *
     * @return Usuario
     */
    public function setNumeroTarjeta($numeroTarjeta)
    {
        $this->numeroTarjeta = $numeroTarjeta;

        return $this;
    }

    /**
     * Get numeroTarjeta
     *
     * @return string
     */
    public function getNumeroTarjeta()
    {
        return $this->numeroTarjeta;
    }

    /**
     * Set ciudad
     *
     * @param Ciudad $ciudad
     *
     * @return Usuario
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
     * Método requerido por la interfaz UserInterface.
     */
    public function getRoles()
    {
        return array('ROLE_USUARIO');
    }

    /**
     * Método requerido por la interfaz UserInterface.
     */
    public function getUsername()
    {
        return $this->getEmail();
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
    public function getSalt()
    {
    }

    /**
     * Validador propio que comprueba si el DNI introducido es válido.
     *
     * El DNI es un identificador único obligatorio para todos los ciudadanos de
     * España y de varios países americanos.
     *
     *   Formato:   entre 1 y 8 números seguidos de 1 letra
     *   Ejemplos:  12345678Z - 11111111H - 01234567L
     *
     * Los números se pueden escoger aleatoriamente, pero la letra depende de los
     * números y por tanto, actúa como carácter de control. ¿Cómo se obtiene la
     * letra a partir de los números?
     *
     *   1. Obtener el 'mod 23' (resto de la división entera) del número
     *      (e.g.: 12345678 mod 23 = 14).
     *   2. Utilizar la siguiente tabla para elegir la letra que corresponde al
     *      resultado de la operación anterior.
     *
     *   +--------+----+----+----+----+----+----+----+----+----+----+----+----+
     *   | mod 23 |  0 |  1 |  2 |  3 |  4 |  5 |  6 |  7 |  8 |  9 | 10 | 11 |
     *   +--------+----+----+----+----+----+----+----+----+----+----+----+----+
     *   | letra  |  T |  R |  W |  A |  G |  M |  Y |  F |  P |  D |  X |  B |
     *   +--------+----+----+----+----+----+----+----+----+----+----+----+----+
     *   | mod 23 | 12 | 13 | 14 | 15 | 16 | 17 | 18 | 19 | 20 | 21 | 22 |    |
     *   +--------+----+----+----+----+----+----+----+----+----+----+----+----+
     *   | letra  |  N |  J |  Z |  S |  Q |  V |  H |  L |  C |  K |  E |    |
     *   +--------+----+----+----+----+----+----+----+----+----+----+----+----+
     *
     * @Assert\Callback
     * @param ExecutionContextInterface $context
     */
    public function esDniValido(ExecutionContextInterface $context)
    {
        $dni = $this->getDni();
        // Comprobar que el formato sea correcto
        if (0 === preg_match("/\d{1,8}[a-z]/i", $dni)) {
            $context->buildViolation('El DNI introducido no tiene el formato correcto (entre 1 y 8 números seguidos de una letra, sin guiones y sin dejar ningún espacio en blanco)')
                ->atPath('dni')
                ->addViolation();
            return;
        }
        // Comprobar que la letra cumple con el algoritmo
        $numero = substr($dni, 0, -1);
        $letra = strtoupper(substr($dni, -1));
        if ($letra !== substr('TRWAGMYFPDXBNJZSQVHLCKE', strtr($numero, 'XYZ', '012') % 23, 1)) {
            $context->buildViolation('La letra no coincide con el número del DNI. Comprueba que has escrito bien tanto el número como la letra')
                ->atPath('dni')
                ->addViolation();
        }
    }

    /**
     * @Assert\IsTrue(message = "Debes tener al menos 18 años para registrarte en el sitio")
     */
    public function isMayorDeEdad()
    {
        return $this->fechaNacimiento <= new \DateTime('today - 18 years');
    }
}

