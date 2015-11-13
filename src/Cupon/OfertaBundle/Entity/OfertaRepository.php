<?php

namespace Cupon\OfertaBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Class OfertaRepository
 * @package Cupon\OfertaBundle\Entity
 */
class OfertaRepository extends EntityRepository
{
    /**
     * Encuentra la oferta del día en la ciudad indicada
     *
     * @param string $ciudad El slug de la ciudad
     */
    public function findOfertaDelDia($ciudad)
    {
        $em = $this->getDoctrine()->getManager();
        $consulta = $em->createQuery('
          SELECT o FROM OfertaBundle:Oferta o
          JOIN o.ciudad c
          WHERE c.slug = :ciudad
          AND o.fechaPublicacion = :fecha');
        $consulta->setParameter('ciudad', 'barcelona');
        $consulta->setParameter('fecha', '201X-XX-XX 00:00:00');
        $oferta = $consulta->getResult();

    }

}