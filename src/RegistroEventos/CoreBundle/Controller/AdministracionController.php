<?php

namespace RegistroEventos\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministracionController extends Controller
{
    public function indexAction()
    {
        return $this->render('RegistroEventosCoreBundle:Administracion:index.html.twig', array(
                // ...
            ));    }

}
