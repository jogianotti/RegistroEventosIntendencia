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
    	$eventosUsuarios = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Usuario')->estadisticaEventosDelUsuario();
    	$eventosTipos = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:TipoEvento')->estadisticaTiposDeEventos();
    	$rectificacionesUsuarios = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Usuario')->estadisticaRectificacionesDelUsuario();
        return $this->render('RegistroEventosCoreBundle:Administracion:administracion.html.twig', array('eventosUsuarios'=>$eventosUsuarios, 'rectificaciones'=>$rectificacionesUsuarios, 'tipos'=>$eventosTipos));
    }
    
    public function supervisionAction()
    {
        return $this->render('RegistroEventosCoreBundle:Administracion:supervision.html.twig');
    }
}
