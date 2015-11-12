<?php

namespace Cupon\OfertaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        /*if (null == $ciudad) {
            $ciudad = $this->container->getParameter('cupon.ciudad_por_defecto');

            return new RedirectResponse(
                $this->generateUrl('portada', array('ciudad' => $ciudad))
            );
        }*/

        $em = $this->getDoctrine()->getManager();

        $date = new \DateTime();
        $date->setDate(2015, 10, 30);
        // 2015-10-30 13:00:00
        $date->setTime(13, 00);

        $oferta = $em->getRepository('OfertaBundle:Oferta')
            ->findOneBy(array(
                'ciudad' => $ciudad,
                'fechaPublicacion' => $date, ));

        // echo $date->format('Y-m-d H:i:s');

        if (!$oferta) {
            throw $this->createNotFoundException('No se ha encontrado ninguna oferta del día');
        }

        return $this->render('OfertaBundle:Default:portada.html.twig', array('oferta' => $oferta));

    }
}
