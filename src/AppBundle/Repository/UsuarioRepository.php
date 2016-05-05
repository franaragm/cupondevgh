<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository
{
    /**
     * Encuentra todas las compras del usuario indicado.
     *
     * @param int $usuarioId El id del usuario
     *
     * @return array
     */
    public function findTodasLasCompras($usuarioId)
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('
            SELECT v, o, t
            FROM AppBundle:Venta v JOIN v.oferta o JOIN o.tienda t
            WHERE v.usuario = :id
            ORDER BY v.fecha DESC
        ');
        $consulta->setParameter('id', $usuarioId);
        return $consulta->getResult();
    }

}