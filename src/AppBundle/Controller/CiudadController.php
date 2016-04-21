<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CiudadController extends Controller
{

    /**
     * Busca todas las ciudades disponibles en la base de datos y pasa la lista
     * a una plantilla muy sencilla que simplemente muestra una lista desplegable
     * para seleccionar la ciudad activa.
     *
     * @param string $ciudad El slug de la ciudad seleccionada
     *
     * @return Response
     */
    public function listaCiudadesAction($ciudad)
    {
        $em = $this->getDoctrine()->getManager();
        $ciudades = $em->getRepository('AppBundle:Ciudad')->findAll();
        return $this->render(':ciudad:_lista_ciudades.html.twig',
            array(
                'ciudadActual' => $ciudad,
                'ciudades' => $ciudades
            )
        );
    }

    /**
     * @Route("/ciudad/cambiar-a-{ciudad}", requirements={ "ciudad" = ".+" }, name="ciudad_cambiar")
     *
     * Cambia la ciudad activa por la que se indica. En el frontend de la
     * aplicación esto simplemente significa que se le redirige al usuario a la
     * portada de la nueva ciudad seleccionada.
     *
     * @param string $ciudad El slug de la ciudad a la que se cambia
     *
     * @return RedirectResponse
     */
    public function cambiarAction($ciudad)
    {
        return $this->redirectToRoute('portada', array('ciudad' => $ciudad));
    }

    /**
     * @Route("/{ciudad}/recientes", name="ciudad_recientes")
     *
     * Muestra las ofertas más recientes de la ciudad indicada.
     *
     * @param string $ciudad El slug de la ciudad
     * @return Response
     * @throws NotFoundHttpException
     */
    public function recientesAction($ciudad)
    {
        $em = $this->getDoctrine()->getManager();

        $ciudad = $em->getRepository('AppBundle:Ciudad')->findOneBySlug($ciudad);

        if (!$ciudad) {
            throw $this->createNotFoundException('La ciudad indicada no está disponible');
        }

        $cercanas = $em->getRepository('AppBundle:Ciudad')->findCercanas($ciudad->getId());
        $ofertas = $em->getRepository('AppBundle:Oferta')->findRecientes($ciudad->getId());

        return $this->render('ciudad/recientes.html.twig', array(
            'ciudad' => $ciudad,
            'cercanas' => $cercanas,
            'ofertas' => $ofertas,
        ));
    }


}
