<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/extranet")
 */
class ExtranetController extends Controller
{
    /**
     * @Route("/login", name="login_extranet")
     */
    public function indexAction()
    {
        return $this->render(':extranet:login.html.twig');
    }

    /**
     * @Route("/dashboard", name="extranet_portada")
     */
    public function portadaAction()
    {
        return $this->render(':extranet:dashboard.html.twig');
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
