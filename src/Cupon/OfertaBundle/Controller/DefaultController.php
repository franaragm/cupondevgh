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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function portadaAction($ciudad)
    {

        $em = $this->getDoctrine()->getManager();
        $oferta = $em->getRepository('OfertaBundle:Oferta')->findOfertaDelDia($ciudad);
        $relacionadas = $em->getRepository('OfertaBundle:Oferta')->findRelacionadas($ciudad);

        if (!$oferta) {
            throw $this->createNotFoundException('No se ha encontrado ninguna oferta del día');
        }

        return $this->render(':frontend:portada.html.twig', array(
            'oferta' => $oferta,
            'relacionadas' => $relacionadas
        ));

    }

    /**
     * Muestra la página de detalle de la oferta indicada
     *
     * @param string $ciudad El slug de la ciudad a la que pertenece la oferta
     * @param string $slug El slug de la oferta (el mismo slug se puede dar en dos o más ciudades diferentes)
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ofertaAction($ciudad, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $oferta = $em->getRepository('OfertaBundle:Oferta')->findOferta($ciudad, $slug);
        $relacionadas = $em->getRepository('OfertaBundle:Oferta')->findRelacionadas($ciudad);

        return $this->render(':frontend:detalle.html.twig', array(
            'oferta'   => $oferta,
            'relacionadas' => $relacionadas
        ));
    }
}
