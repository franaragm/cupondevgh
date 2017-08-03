<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Oferta;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Venta;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Esta clase encapsula algunas operaciones que se realizan habitualmente sobre
 * las entidades de tipo Oferta.
 */
class OfertaManager
{

    private $em;
    private $container;

    public function __construct(ObjectManager $entityManager, ContainerInterface $container)
    {
        $this->em = $entityManager;
        $this->container = $container;
    }

    /**
     * @param Oferta  $oferta
     * @param Usuario $usuario
     */
    public function comprar(Oferta $oferta, Usuario $usuario)
    {
        $venta = new Venta();
        $venta->setOferta($oferta);
        $venta->setUsuario($usuario);
        $venta->setFecha(new \DateTime());
        $this->em->persist($venta);
        $oferta->setCompras($oferta->getCompras() + 1);
        $this->em->flush();
    }

    /**
     * @param Oferta $oferta
     */
    public function guardar(Oferta $oferta)
    {
        $oferta->setFechaActualizacion(new \DateTime('now'));
        if (null !== $oferta->getFotoTemp()) {
            $oferta->subirFoto( $this->container->getParameter('app.directorio.imagenes') );
        }

        $this->em->persist($oferta);
        $this->em->flush();
    }
}