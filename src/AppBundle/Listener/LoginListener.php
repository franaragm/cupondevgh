<?php

namespace AppBundle\Listener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;


class LoginListener
{
    private $checker, $router, $ciudad = null;

    public function __construct(AuthorizationChecker $checker, Router $router)
    {
        $this->checker = $checker;
        $this->router = $router;
    }

    /**
     * Captura el objeto event cuando un usuario hace login y
     * se guarda el slug de su ciudad
     *
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        // obtención de token asociado al usuario que acaba de hacer login
        $token = $event->getAuthenticationToken();
        $this->ciudad = $token->getUser()->getCiudad()->getSlug();
    }

    /**
     * Redirige al usuario a su portada correspondiente a su ciudad
     *
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (null === $this->ciudad) {
            return;
        }

        if($this->checker->isGranted('ROLE_TIENDA')) {
            $urlPortada = $this->router->generate('extranet_portada');
        } else {
            $urlPortada = $this->router->generate('portada', array(
                'ciudad' => $this->ciudad
            ));
        }

        $event->setResponse(new RedirectResponse($urlPortada));
        $event->stopPropagation();
    }

}