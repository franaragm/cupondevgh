<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\Usuario;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

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

    /**
     * @Route("/registro", name="usuario_registro")
     *
     * Muestra el formulario para que se registren los nuevos usuarios. Además
     * se encarga de procesar la información y de guardar la información en la base de datos.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function registroAction(Request $request)
    {
        $usuario = new Usuario();

        $formulario = $this->createForm('AppBundle\Form\UsuarioType', $usuario, array(
            'accion' => 'crear_usuario',
            // grupos de verificacion que esta incluido este formulario
            'validation_groups' => array('Default', 'registro'),
        ));
        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $this->get('app.manager.usuario_manager')->guardar($usuario);
            $this->get('app.manager.usuario_manager')->loguear($usuario);

            $this->addFlash('alert-success', '¡Enhorabuena! Te has registrado correctamente en Cupon');

            return $this->redirectToRoute('portada', array(
                'ciudad' => $usuario->getCiudad()->getSlug()
            ));
        }

        return $this->render('usuario/registro.html.twig', array(
            'formulario' => $formulario->createView())
        );
    }

    /**
     * @Route("/perfil", name="usuario_perfil")
     *
     * Muestra el formulario con toda la información del perfil del usuario logueado.
     * También permite modificar la información y guarda los cambios en la base de datos.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function perfilAction(Request $request)
    {
        $usuario = $this->getUser();
        $formulario = $this->createForm('AppBundle\Form\UsuarioType', $usuario,
            array('accion' => 'modificar_perfil')
        );
        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $this->get('app.manager.usuario_manager')->guardar($usuario);
            $this->addFlash('alert-success', 'Los datos de tu perfil se han actualizado correctamente');
            return $this->redirectToRoute('usuario_perfil');
        }
        return $this->render('usuario/perfil.html.twig', array(
            'usuario' => $usuario,
            'formulario' => $formulario->createView(),
        ));
    }
}
