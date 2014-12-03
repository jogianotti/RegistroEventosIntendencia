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
        return new Response('ADMINISTRACION');
    }
    
    public function supervisionAction()
    {
        return new Response('SUPERVISION');
    }
}
