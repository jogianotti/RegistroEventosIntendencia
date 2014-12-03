<?php

namespace RegistroEventos\CoreBundle\Handler;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{   
    protected $router;
    protected $security;

    public function __construct(Router $router, SecurityContext $security)
    {
        $this->router   = $router;
        $this->security = $security;
    }
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {   
        $response = new RedirectResponse($this->router->generate('eventos'));
        
        if ($this->security->isGranted('ROLE_ADMINISTRADOR'))
        {
            $response = new RedirectResponse($this->router->generate('registro_eventos_core_administracion'));           
        }
        elseif ($this->security->isGranted('ROLE_SUPERVISOR'))
        {
            $response = new RedirectResponse($this->router->generate('registro_eventos_core_supervision'));
        }
        elseif ($this->security->isGranted('ROLE_INTENDENTE'))
        {
            $response = new RedirectResponse($this->router->generate('eventos'));
        }
        
        return $response;
    } 
}