<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/usuario")
 */
class UsuarioController extends Controller
{
    /**
     * @Route("/compras/", name="usuario_compras")
     *
     * Muestra todas las compras del usuario logueado.
     *
     * @return Response
     */
    public function comprasAction()
    {
        $usuario_id = 1;
        $em = $this->getDoctrine()->getManager();
        // $usuario = $this->get('security.token_storage')->getToken()->getUser();
//        $cercanas = $em->getRepository('AppBundle:Ciudad')->findCercanas(
//            $usuario->getCiudad()->getId()
//        );
        $compras_usuario = $em->getRepository('AppBundle:Usuario')->findTodasLasCompras($usuario_id);
        return $this->render('usuario/compras.html.twig', array(
            'compras_usuario' => $compras_usuario,
            //'cercanas' => $cercanas,
        ));
    }
}
