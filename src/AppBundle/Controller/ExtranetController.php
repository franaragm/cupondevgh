<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ExtranetController extends Controller
{
    /**
     * @Route("/login", name="extranet_login")
     */
    public function loginAction()
    {
        $authUtils = $this->get('security.authentication_utils');

        return $this->render('extranet/login.html.twig', array(
            'last_username' => $authUtils->getLastUsername(),
            'error' => $authUtils->getLastAuthenticationError(),
        ));

    }

    /**
     * @Route("/login_check", name="extranet_login_check")
     */
    public function loginCheckAction()
    {
        // el "login check" lo hace Symfony automáticamente
    }

    /**
     * @Route("/logout", name="extranet_logout")
     */
    public function logoutAction()
    {
        // el logout lo hace Symfony automáticamente
    }

    /**
     * @Route("/", name="extranet_portada")
     */
    public function portadaAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tienda = $this->getUser();
        $ofertas = $em->getRepository('AppBundle:Tienda')->findOfertasRecientes($tienda->getId());

        return $this->render(':extranet:dashboard.html.twig', array(
            'ofertas_tienda' => $ofertas
        ));
    }

    /**
     * @Route("/oferta/ventas/{id}", name="extranet_oferta_ventas")
     */
    public function ofertaVentasAction()
    {
        return $this->render(':extranet:dashboard.html.twig');
    }

    /**
     * @Route("/oferta/nueva", name="extranet_oferta_nueva")
     */
    public function ofertaNuevaAction()
    {
        return $this->render(':extranet:dashboard.html.twig');
    }

    /**
     * @Route("/oferta/editar/{id}", name="extranet_oferta_editar")
     */
    public function ofertaEditarAction()
    {
        return $this->render(':extranet:dashboard.html.twig');
    }

    /**
     * @Route("/perfil", name="extranet_perfil")
     */
    public function perfilAction()
    {
        return $this->render(':extranet:dashboard.html.twig');
    }
}
