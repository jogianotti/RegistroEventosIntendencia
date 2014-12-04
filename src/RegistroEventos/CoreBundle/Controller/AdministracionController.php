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
    	//aca pedir estadisticas... y renderizar
    	$eventosUsuarios = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Usuario')->eventosDelUsuario();
    	foreach ($eventosUsuarios as $key => $value) {
    		echo $value["nombre"].' - '.$value["eventos"].'<br>';
    	}

    	
        return $this->render('RegistroEventosCoreBundle:Administracion:administracion.html.twig');
    }
    
    public function supervisionAction()
    {
        return $this->render('RegistroEventosCoreBundle:Administracion:supervision.html.twig');
    }
}
