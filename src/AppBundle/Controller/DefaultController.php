<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     *@Route("/{ciudad}/", defaults={ "ciudad" = "%app.ciudad_por_defecto%" }, name="portada")
     *
     * Muestra la portada del sitio web
     *
     * @param string $ciudad El slug de la ciudad activa en la aplicación
     *
     * @return Response
     *
     * @throws NotFoundHttpException
     */
    public function portadaAction($ciudad)
    {

        $em = $this->getDoctrine()->getManager();
        $oferta = $em->getRepository('AppBundle:Oferta')->findOfertaDelDia($ciudad);
        $ofertas_cercanas = $em->getRepository('AppBundle:Oferta')->findCercanas($ciudad);

        if (!$oferta) {
            throw $this->createNotFoundException('No se ha encontrado ninguna oferta del día');
        }

        return $this->render(':sitio:portada.html.twig', array(
            'oferta' => $oferta,
            'ofertas_cercanas' => $ofertas_cercanas
        ));

    }
}
