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
            array('usuarioLogueado' => $this->get('security.context')->getToken()->getUser(),
                'usuarios' => $usuarios )
    	);
    }

    public function crearUsuarioAction(Request $request) {
        $userManager = $this->get('fos_user.user_manager');
        $usuario = $userManager->createUser();
        $formulario = $this->createForm(new UsuarioType(),$usuario);
        $usuario = $userManager->createUser();
        $formulario->handleRequest($request);
        if($formulario->isValid()) {
            $usuario->setBaja(FALSE);
            $usuario->setEnabled(TRUE);
            $userManager->updateUser($usuario);
            return new Response('Agregado el nuevo usuario.');
        }
        
        return $this->render('RegistroEventosCoreBundle:Administracion:crearUsuario.html.twig', array('form'=>$formulario->createView()));
    }

    public function modificarUsuarioAction(Request $request) {
        $userManager = $this->get('fos_user.user_manager');
        $username = $request->query->get('username');
        $usuario = $userManager->findUserByUsername($username);
        $formulario = $this->createForm(new UsuarioType(),$usuario);
        
        $formulario->handleRequest($request);
        if($formulario->isValid()) {
            $userManager->updateUser($usuario);
            return $this->forward('RegistroEventosCoreBundle:Administracion:listarUsuarios');
        }
        
        return $this->render('RegistroEventosCoreBundle:Administracion:modificarUsuario.html.twig', array('form'=>$formulario->createView(), 'usuario' => $usuario));
    }

    public function eliminarUsuarioAction(Request $request) {
        $userManager = $this->get('fos_user.user_manager');
        $username = $request->query->get('username');
        $usuario = $userManager->findUserByUsername($username);

        if($usuario == NULL || $usuario === $this->get('security.context')->getToken()->getUser()){
            return $this->forward('RegistroEventosCoreBundle:Administracion:listarUsuarios');
        }
        $usuario->setBaja(true);

        $userManager->updateUser($usuario);
        return $this->forward('RegistroEventosCoreBundle:Administracion:listarUsuarios');
    }
}
