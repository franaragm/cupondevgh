<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/usuario")
 */
class UsuarioController extends Controller
{
    /**
     * @Route("/login", name="usuario_login")
     *
     * Muestra el formulario de login
     *
     * @return Response
     */
    public function loginAction()
    {
        $authUtils = $this->get('security.authentication_utils');

        return $this->render(':usuario:login.html.twig', array(
            'last_username' => $authUtils->getLastUsername(),
            'error' => $authUtils->getLastAuthenticationError(),
        ));
    }

    /**
     * @Route("/login_check", name="usuario_login_check")
     */
    public function loginCheckAction()
    {
        // el "login check" lo hace Symfony automáticamente
    }

    /**
     * @Route("/logout", name="usuario_logout")
     */
    public function logoutAction()
    {
        // el logout lo hace Symfony automáticamente
    }

    /**
     * @Route("/compras/", name="usuario_compras")
     *
     * Muestra todas las compras del usuario logueado.
     *
     * @return Response
     */
    public function comprasAction()
    {
        //$usuario_id = 1;
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
//        $cercanas = $em->getRepository('AppBundle:Ciudad')->findCercanas(
//            $usuario->getCiudad()->getId()
//        );
        $compras_usuario = $em->getRepository('AppBundle:Usuario')->findTodasLasCompras($usuario->getId());
        return $this->render('usuario/compras.html.twig', array(
            'compras_usuario' => $compras_usuario,
            //'cercanas' => $cercanas,
        ));
    }
}