<?php

namespace RegistroEventos\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministracionController extends Controller
{
    public function indexAction()
    {
        return $this->render('RegistroEventosCoreBundle:Administracion:index.html.twig', array(
                // ...
            ));
    }

    public function usuariosAction() {
    	$usuarios = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Usuario')->listar();

    	foreach ($usuarios as $usuario){
    		/*echo $usuario->getNombre() . ' - ' .*/ print_r($usuario->getRoles());
    	}
    	die();
/*    	$this->twig->render('RegistroEventosCoreBundle:Administracion:usuarios.html.twig',
    		//Pasar Usuario logueado fixme!!!! ;)
    		array('usuarios' => $usuarios )
    	);
*/    }

    public function altaUsuarioAction() {
    	$um = $this->get('fos_user.user_manager');
    }

    
}
