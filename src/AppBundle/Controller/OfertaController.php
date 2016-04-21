<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OfertaController extends Controller
{
    /**
     * @Route("/{ciudad}/ofertas/{slug}/", name="oferta")
     *
     * Muestra la página de detalle de la oferta indicada
     *
     * @param string $ciudad El slug de la ciudad a la que pertenece la oferta
     * @param string $slug El slug de la oferta (el mismo slug se puede dar en dos o más ciudades diferentes)
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ofertaAction($ciudad, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $oferta = $em->getRepository('AppBundle:Oferta')->findOferta($ciudad, $slug);
        $ofertas_cercanas = $em->getRepository('AppBundle:Oferta')->findCercanas($ciudad);

        return $this->render(':oferta:detalle.html.twig', array(
            'oferta'   => $oferta,
            'ofertas_cercanas' => $ofertas_cercanas
        ));
    }
}
