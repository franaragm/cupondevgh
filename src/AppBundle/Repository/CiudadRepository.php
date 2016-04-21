<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CiudadRepository extends EntityRepository
{
    /**
     * Encuentra las cinco ciudades más cercanas a la ciudad indicada.
     *
     * @param int $ciudadId El id de la ciudad para la que se buscan cercanas
     *
     * @return array
     */
    public function findCercanas($ciudadId)
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('
            SELECT c
            FROM AppBundle:Ciudad c
            WHERE c.id != :id
            ORDER BY c.nombre ASC
        ');
        $consulta->setMaxResults(5);
        $consulta->setParameter('id', $ciudadId);
        return $consulta->getResult();
    }

}