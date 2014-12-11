<?php

namespace RegistroEventos\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use RegistroEventos\CoreBundle\Form\Type\UsuarioType;

class AdministracionController extends Controller
{
    public function indexAction()
    {
        return $this->render('RegistroEventosCoreBundle:Administracion:administracion.html.twig');
    }
    
    public function supervisionAction()
    {
        return $this->render('RegistroEventosCoreBundle:Administracion:supervision.html.twig');
    }
}