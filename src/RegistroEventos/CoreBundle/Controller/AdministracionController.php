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
        $usuario = $this->get('security.context')->getToken()->getUser();
        
        $usuario = $usuario->getUsername();
        
        return $this->render('RegistroEventosCoreBundle:Administracion:index.html.twig', array('user' => $usuario,
            ));
    }

    public function listarUsuariosAction() {
    	$usuarios = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Usuario')->listar();

    	return$this->render('RegistroEventosCoreBundle:Administracion:listarUsuarios.html.twig',
            array('usuarios' => $usuarios )
    	);
    }

    public function crearUsuarioAction(Request $request) {
        $userManager = $this->get('fos_user.user_manager');
        $usuario = $userManager->createUser();
        $formulario = $this->createForm(new UsuarioType(),$usuario);
        
        $formulario->handleRequest($request);
        if($formulario->isValid()) {
            $usuario->setBaja(FALSE);
            $usuario->setEnabled(FALSE);
            $userManager->updateUser($usuario);
            return new Response('Agregado el nuevo usuario.');
        }
        
        return $this->render('RegistroEventosCoreBundle:Administracion:crearUsuario.html.twig', array('form'=>$formulario->createView()));
    }

    public function eliminarUsuarioAction() {
    	$um = $this->get('fos_user.user_manager');
    }
}
