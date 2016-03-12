<?php

namespace Cupon\CiudadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    /**
     * Cambia la ciudad activa por la que se indica. En el frontend de la
     * aplicación esto simplemente significa que se le redirige al usuario a la
     * portada de la nueva ciudad seleccionada.
     *
     * @param string $ciudad El slug de la ciudad a la que se cambia
     * @return RedirectResponse
     */
    public function cambiarAction($ciudad)
    {
        return new RedirectResponse($this->generateUrl('portada', array('ciudad' => $ciudad)));
    }

    /**
     * Busca todas las ciudades disponibles en la base de datos y pasa la lista
     * a una plantilla muy sencilla que simplemente muestra una lista desplegable
     * para seleccionar la ciudad activa.
     *
     * @param string $ciudad El slug de la ciudad seleccionada
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listaCiudadesAction($ciudad)
    {
        $em = $this->getDoctrine()->getManager();
        $ciudades = $em->getRepository('CiudadBundle:Ciudad')->findAll();
        return $this->render(':frontend/miniviews:listaCiudades.html.twig',
            array(
                'ciudadActual'  => $ciudad,
                'ciudades'      => $ciudades
            )
        );
    }
}
