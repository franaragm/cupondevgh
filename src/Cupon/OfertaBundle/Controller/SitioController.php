<?php

namespace Cupon\OfertaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controlador para paginas estaticas
 */
class SitioController extends Controller
{
    /**
     * @param string $pagina
     * @return null
     */
    public function estaticaAction($pagina)
    {
        return $this->render(':estaticas:'.$pagina.'.html.twig');
    }
}
