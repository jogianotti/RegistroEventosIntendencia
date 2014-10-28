<?php

namespace RegistroEventos\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$usuario = null;
    	/*$usuario["id"] = '1';
    	$usuario["nombre"] = 'Pablo';
    	$usuario["rango"] = '1';*/
        return $this->render('RegistroEventosCoreBundle::index.html.twig', array('usuario' => $usuario));
    }
}
