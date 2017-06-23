<?php

namespace AppBundle\Security;

use AppBundle\Entity\Oferta;
use AppBundle\Entity\Tienda;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Este voter decide si la oferta puede ser accedida por la tienda actualmente logueada
 * en base a si la tienda es autora de la oferta
 */
class CreadorOfertaVoter extends Voter
{
    // en estos strings puedes poner lo que quieras
    const VIEW = 'view';
    const EDIT = 'edit';

    public function supports($attribute, $subject)
    {
        // si el atributo no es uno de los que soportamos, devolver false
        if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
            return false;
        }

        // sólo votar en objetos Oferta dentro de este voter
        if (!$subject instanceof Oferta) {
            return false;
        }

        return true;
    }

    /**
     * Devuelve 'true' si el usuario logueado es de tipo Tienda y es el creador de la oferta.
     *
     * @param string         $attribute
     * @param mixed          $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $tienda = $token->getUser();
        return $tienda instanceof Tienda && $subject->getTienda()->getId() === $tienda->getId();
    }
}