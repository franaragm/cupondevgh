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
     *
     * Muestra las ventas registradas para la oferta indicada y deniega acceso a ver ofertas de otras tiendas.
     *
     * @param int $id id de la Oferta
     *
     * @return Response
     */
    public function ofertaVentasAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $oferta = $em->getRepository('AppBundle:Oferta')->findOneById($id);
        $ventas = $em->getRepository('AppBundle:Oferta')->findVentasByOferta($id);

        $authChecker = $this->get('security.authorization_checker');

        if (!$authChecker->isGranted('view', $oferta)) {
            $this->addFlash('alert-danger', 'No puede acceder a la información de una oferta de otra tienda!');

            return $this->redirectToRoute('extranet_portada');
        }

        return $this->render('extranet/ventas.html.twig', array(
            'oferta' => $oferta,
            'ventas' => $ventas,
        ));
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
