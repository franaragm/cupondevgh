<?php

namespace Cupon\OfertaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controlador por defecto
 */
class DefaultController extends Controller
{
    /**
     * Muestra la portada del sitio web
     *
     * @param string $ciudad El slug de la ciudad activa en la aplicación
     * @return null
     */
    public function portadaAction($ciudad)
    {

        $em = $this->getDoctrine()->getManager();
        $oferta = $em->getRepository('OfertaBundle:Oferta')->findOfertaDelDia($ciudad);

        if (!$oferta) {
            throw $this->createNotFoundException('No se ha encontrado ninguna oferta del día');
        }

        return $this->render('::portada.html.twig', array('oferta' => $oferta));

    }
}
