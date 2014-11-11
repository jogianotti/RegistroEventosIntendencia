<?php

namespace RegistroEventos\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SupervisionController extends Controller
{
    public function indexAction()
    {
        return $this->render('RegistroEventosCoreBundle:Supervision:index.html.twig', array(
                // ...
            ));    }

}
