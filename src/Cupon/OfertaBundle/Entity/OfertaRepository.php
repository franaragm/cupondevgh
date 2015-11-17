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
     *
     * @return object
     */
    public function findOfertaDelDia($ciudad)
    {
        $date = new \DateTime('today');
        $date->setTime(23, 59, 59);

        // $date = new \DateTime();
        // $date->setDate(2015, 10, 30);
        // 2015-10-30 13:00:00
        // $date->setTime(13, 00);

        $em = $this->getEntityManager();

        $dql = 'SELECT o, c, t
                  FROM OfertaBundle:Oferta o
                  JOIN o.ciudad c JOIN o.tienda t
                WHERE o.revisada = TRUE
                  AND o.fechaPublicacion < :fecha
                  AND c.slug = :ciudad
                ORDER BY o.fechaPublicacion DESC';

        $consulta = $em->createQuery($dql);
        $consulta->setParameter('ciudad', $ciudad);
        $consulta->setParameter('fecha', $date);
        $consulta->setMaxResults(1);

        return $consulta->getSingleResult();

    }

}