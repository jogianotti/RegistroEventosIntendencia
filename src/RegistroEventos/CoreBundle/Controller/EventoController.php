<?php

namespace RegistroEventos\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RegistroEventos\CoreBundle\Entity\Evento;
use RegistroEventos\CoreBundle\Form\EventoType;
use RegistroEventos\CoreBundle\Entity\Detalle;
use RegistroEventos\CoreBundle\Form\DetalleType;

/**
 * Evento controller.
 *
 */
class EventoController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $evento = new Evento();
        $evento->setFechaEvento(new \DateTime());
        $evento->setEstado(true);
        $form = $this->createCreateForm($evento);

        $eventosAbiertos = $em->getRepository('RegistroEventosCoreBundle:Evento')->buscarEventosAbiertos();
        $eventosCerrados = $em->getRepository('RegistroEventosCoreBundle:Evento')->buscarEventosCerrados();
        $tiposEvento = $em->getRepository('RegistroEventosCoreBundle:TipoEvento')->listarTiposEventosActivos();

        $formularioBusqueda = $this->crearFormularioBusqueda($this->generateUrl('eventos_busqueda'));
        return $this->render('RegistroEventosCoreBundle:Evento:index.html.twig', array(
                    'eventosAbiertos' => $eventosAbiertos,
                    'eventosCerrados' => $eventosCerrados,
                    'form' => $form->createView(),
                    'evento' => $evento,
                    'seccion' => 'registro',
                    'formularioBusqueda' => $formularioBusqueda->createView(),
                    'tiposEvento' => $tiposEvento
        ));
    }

    public function busquedaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repositorioEventos = $em->getRepository('RegistroEventosCoreBundle:Evento');
        $repositorioTiposEvento = $em->getRepository('RegistroEventosCoreBundle:TipoEvento');

        $evento = new Evento();
        $evento->setFechaEvento(new \DateTime());
        $evento->setEstado(true);
        $form = $this->createCreateForm($evento);

        $formularioBusqueda = $this->crearFormularioBusqueda($this->generateUrl('eventos_busqueda'));
        $formularioBusqueda->handleRequest($request);

        $datos = $formularioBusqueda->getData();
        $datos['fechaDesde'] = \DateTime::createFromFormat('d/m/Y H:i', $request->request->get('fechaDesde'));
        $datos['fechaHasta'] = \DateTime::createFromFormat('d/m/Y H:i', $request->request->get('fechaHasta'));
        
        if ($formularioBusqueda->isValid()) {
            
            
            $eventosAbiertos = array();
            $eventosCerrados = array();
            if (is_null($datos['estado'])) {
                $eventosAbiertos = $repositorioEventos->buscarEventosAbiertosPor($datos);
                $eventosCerrados = $repositorioEventos->buscarEventosCerradosPor($datos);
            } else {
                if ($datos['estado']) {
                    $eventosAbiertos = $repositorioEventos->buscarEventosAbiertosPor($datos);
                } else {
                    $eventosCerrados = $repositorioEventos->buscarEventosCerradosPor($datos);
                }
            }
        } else {
            $eventosAbiertos = $repositorioEventos->buscarEventosAbiertos();
            $eventosCerrados = $repositorioEventos->buscarEventosCerrados();
        }
        $tiposEvento = $repositorioTiposEvento->listarTiposEventosActivos();

        return $this->render('RegistroEventosCoreBundle:Evento:index.html.twig', array(
                    'eventosAbiertos' => $eventosAbiertos,
                    'eventosCerrados' => $eventosCerrados,
                    'form' => $form->createView(),
                    'evento' => $evento,
                    'seccion' => 'busqueda',
                    'formularioBusqueda' => $formularioBusqueda->createView(),
                    'tiposEvento' => $tiposEvento
        ));
    }

    private function crearFormularioBusqueda($datosIniciales)
    {
        $tiposEventos = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:TipoEvento')->listarTiposEventosBusqueda();
        $opcionesTipoEvento = array();
        foreach ($tiposEventos as $te) {
            $opcionesTipoEvento[$te->getId()] = $te->getNombre();
        }

        $usuarios = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Usuario')->listarIntendentesBusqueda();
        $opcionesUsuarios = array();
        foreach ($usuarios as $u) {
            $opcionesUsuarios[$u->getId()] = $u->getNombre();
        }

        $formBuilder = $this->createFormBuilder();
        $formBuilder->setAction($datosIniciales);
        $formBuilder->setMethod('POST');
        $formBuilder->add('tipoEvento', 'choice', array(
                    'choices' => $opcionesTipoEvento,
                    'required' => false,
                    'expanded' => false,
                    'multiple' => false
                ))
                ->add('usuario', 'choice', array(
                    'choices' => $opcionesUsuarios,
                    'required' => false,
                    'expanded' => false,
                    'multiple' => false
                ))
                ->add('estado', 'choice', array(
                    'choices' => array(true => 'Abierto', false => 'Cerrado'),
                    'label' => 'Estado del evento',
                    'required' => false,
                    'expanded' => false,
                    'multiple' => false
                ))
                ->add('observaciones', 'text', array(
                    'required' => false
                ))
                ->add('fechaDesde', 'datetime', array(
                    'data' => new \DateTime(),
                    'required' => false
                ))
                ->add('fechaHasta', 'datetime', array(
                    'required' => false
                ))
                ->add('Buscar', 'submit');
        return $formBuilder->getForm();
    }

    public function crearAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $evento = new Evento();

        $form = $this->createCreateForm($evento);
        $form->handleRequest($request);

        $date = \DateTime::createFromFormat('d/m/Y H:i', $request->request->get('fechaEvento'));
        $evento->setFechaEvento($date);

        $evento->setFechaSistema(new \DateTime());
        $evento->setUsuario($this->get('security.context')->getToken()->getUser());

        $eventosAbiertos = $em->getRepository('RegistroEventosCoreBundle:Evento')->buscarEventosAbiertos();
        $eventosCerrados = $em->getRepository('RegistroEventosCoreBundle:Evento')->buscarEventosCerrados();
        $tiposEvento = $em->getRepository('RegistroEventosCoreBundle:TipoEvento')->listarTiposEventosActivos();
        $formularioBusqueda = $this->crearFormularioBusqueda($this->generateUrl('eventos_busqueda'));


        if ($form->isValid()) {
            $em->persist($evento);
            $em->flush();

            $this->informar($evento);

            return $this->redirect($this->generateUrl('eventos'));
        }


        return $this->render('RegistroEventosCoreBundle:Evento:index.html.twig', array(
                    'evento' => $evento,
                    'form' => $form->createView(),
                    'eventosAbiertos' => $eventosAbiertos,
                    'eventosCerrados' => $eventosCerrados,
                    'seccion' => 'registro',
                    'tiposEvento' => $tiposEvento,
                    'formularioBusqueda' => $formularioBusqueda->createView()
        ));
    }

    private function createCreateForm(Evento $entity)
    {
        $form = $this->createForm(new EventoType(), $entity, array(
            'action' => $this->generateUrl('eventos_crear'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    public function nuevaRectificacionAction(Request $request)
    {
        $id = $request->request->get('id', NULL);
        $eventoRectificado = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Evento')->findOneBy(array('id' => $id));

        if ($eventoRectificado->getUsuario() !== $this->get('security.context')->getToken()->getUser()) {
            return new JsonResponse(array('estado' => FALSE, 'mensaje' => 'Operación no permitida'));
        }

        $rectificacion = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Evento')->findOneBy(array('rectificacion' => $eventoRectificado));
        $rectificaciones = null;
        while (!is_null($rectificacion)) {
            $rectificaciones[] = $rectificacion;
            $rectificacion = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Evento')->findOneBy(array('rectificacion' => $rectificacion));
        }

        $evento = new Evento();
        $evento->setFechaEvento($eventoRectificado->getFechaEvento());
        $evento->setTipoEvento($eventoRectificado->getTipoEvento());
        $evento->setObservaciones($eventoRectificado->getObservaciones());
        $evento->setEstado($eventoRectificado->getEstado());

        $form = $this->createForm(new EventoType(), $evento, array(
            'action' => $this->generateUrl('eventos_rectificacion_crear'),
            'method' => 'POST',
        ));

        if (is_null($id)) {
            $vista = $this->renderView('RegistroEventosCoreBundle:Evento:rectificar.html.twig', array(
                'error' => true
            ));
            return new JsonResponse(array('estado' => TRUE, 'vista' => $vista));
        } else {
            $vista = $this->renderView('RegistroEventosCoreBundle:Evento:rectificar.html.twig', array(
                'form' => $form->createView(),
                'eventoRectificado' => $eventoRectificado,
                'rectificaciones' => $rectificaciones,
                'error' => false,
                'datetimeEvento' => $evento->getFechaEvento()->format('d/m/Y H:i')
            ));

            return new JsonResponse(array('estado' => TRUE, 'vista' => $vista));
        }
    }

    public function crearRectificacionAction(Request $request)
    {
        $id = $request->request->get('eventoRectificadoId', NULL);

        $eventoRectificado = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Evento')->findOneBy(array('id' => $id));
        if ($eventoRectificado->getUsuario() !== $this->get('security.context')->getToken()->getUser()) {
            return new JsonResponse(array('estado' => FALSE, 'mensaje' => 'Operación no permitida'));
        }

        $evento = new Evento();
        $form = $this->createForm(new EventoType(), $evento);
        $form->handleRequest($request);
        $evento->setFechaSistema(new \DateTime());
        $evento->setUsuario($this->get('security.context')->getToken()->getUser());

        $fechaEvento = \DateTime::createFromFormat('d/m/Y H:i', $request->request->get('fechaEvento'));
        $evento->setFechaEvento($fechaEvento);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($evento);
            $em->flush();

            $eventoRectificado->setRectificacion($evento);

            $em->persist($eventoRectificado);
            $em->flush();

            return new JsonResponse(array(
                'estado' => TRUE,
                'rectificado' => TRUE,
                'evento' => $evento,
                'eventoRectificado' => $eventoRectificado));
//            return $this->redirect($this->generateUrl('eventos'));
        }
        $vista = $this->renderView('RegistroEventosCoreBundle:Evento:rectificar.html.twig', array(
            'form' => $form->createView(),
            'eventoRectificado' => $eventoRectificado,
            'error' => false
        ));
        return new JsonResponse(array('estado' => TRUE, 'rectificado' => FALSE, 'html' => $vista));
    }

    public function cerrarEventoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $evento = $em->getRepository('RegistroEventosCoreBundle:Evento')->findOneBy(array('id' => $id));
        $evento->setEstado(FALSE);

        $em->persist($evento);
        $em->flush();

        return $this->redirect($this->generateUrl('eventos')); //'RegistroEventosCoreBundle:Evento:index');
    }

    public function abrirEventoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $evento = $em->getRepository('RegistroEventosCoreBundle:Evento')->findOneBy(array('id' => $id));
        $evento->setEstado(TRUE);

        $em->persist($evento);
        $em->flush();

        return $this->redirect($this->generateUrl('eventos')); //    forward('RegistroEventosCoreBundle:Evento:index');
    }

    public function detalleEventoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $evento = $em->getRepository('RegistroEventosCoreBundle:Evento')->find($id);

        if (!$evento) {
            throw $this->createNotFoundException(
                    'No se encontro el evento ' . $id
            );
        }

        $detallesActuales = $em->getRepository('RegistroEventosCoreBundle:Evento')->listarDetallesPara($evento);

        $detalle = new Detalle();
        $datetimeActual = new \DateTime();
        $detalle->setFechaDetalle($datetimeActual);
        $form = $this->createForm(new DetalleType(), $detalle);

        return $this->render('RegistroEventosCoreBundle:Evento:detalle.html.twig', array(
                    'form' => $form->createView(),
                    'detalles' => $detallesActuales,
                    'evento' => $evento,
                    'datetimeActual' => $datetimeActual->format('d/m/Y H:i')
                        )
        );
    }

    public function crearDetalleEventoAction(Request $request)
    {
        $eventoId = $request->request->get('eventoId');
        $em = $this->getDoctrine()->getManager();
        $evento = $em->getRepository('RegistroEventosCoreBundle:Evento')->findOneBy(array('id' => $eventoId));

        $detalle = new Detalle();
        $form = $this->createForm(new DetalleType(), $detalle);
        $form->handleRequest($request);

        $datetimeActual = new \DateTime();

        $detalle->setFechaSistema($datetimeActual);
        $detalle->setUsuario($this->get('security.context')->getToken()->getUser());
        $detalle->setEvento($evento);
        $fechaDetalle = \DateTime::createFromFormat('d/m/Y H:i', $request->request->get('fechaDetalle'));
        $detalle->setFechaDetalle($fechaDetalle);

        if ($form->isValid()) {
            $em->persist($detalle);
            $em->flush();

            $detalles = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Evento')->listarDetallesPara($evento);
            $vista = $this->renderView('RegistroEventosCoreBundle:Evento:detalle.html.twig', array(
                'form' => $this->createForm(new DetalleType(), new Detalle())->createView(),
                'detalles' => $detalles,
                'evento' => $evento,
                'datetimeActual' => $datetimeActual->format('d/m/Y H:i')
            ));
            return new JsonResponse(array('agregado' => TRUE, 'html' => $vista));
        }
        $detalles = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Evento')->listarDetallesPara($evento);
        $vista = $this->renderView('RegistroEventosCoreBundle:Evento:detalle.html.twig', array(
            'form' => $form->createView(),
            'detalles' => $detalles,
            'evento' => $evento,
            'datetimeActual' => $datetimeActual->format('d/m/Y H:i')
        ));
        return new JsonResponse(array('agregado' => FALSE, 'html' => $vista));
    }

    private function informar($evento)
    {
        $email = $evento->getTipoEvento()->getEmail();
        if (!is_null($email)) {
            $mensaje = \Swift_Message::newInstance()
                    ->setSubject('Alerta de evento')
                    ->setFrom('r11alex.nestor@gmail.com')
                    ->setTo($email)
                    ->setBody(
                    $this->renderView(
                            'RegistroEventosCoreBundle:Evento:email.txt.twig', array(
                        'tipo' => $evento->getTipoEvento()->getNombre(),
                        'usuario' => $evento->getUsuario()->getNombre(),
                        'observaciones' => $evento->getObservaciones(),
                        'fechaEvento' => $evento->getFechaEvento()->format('d/m/Y H:i'),
                        'fechaRegistro' => $evento->getFechaSistema()->format('d/m/Y H:i')
                            )
                    )
            );

            $this->get('mailer')->send($mensaje);
        }
    }

    public function supervisionAction(Request $request) {
        $repositorioEventos = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Evento');
        
        $formularioBusqueda = $this->crearFormularioBusqueda($this->generateUrl('eventos_supervision'));
        
//        if(!is_null($request->request->get('fechaDesde'))) {
//            $formularioBusqueda->get('fechaDesde')->setData(\DateTime::createFromFormat('d/m/Y H:i', $request->request->get('fechaDesde')));
//        }
//        if(count($request->request->get('fechaHasta')) > 0) {
//            $fecha = \DateTime::createFromFormat('d/m/Y H:i', $request->request->get('fechaHasta'));
//            $formularioBusqueda->get('fechaHasta')->setData($fecha);
//        }
        $formularioBusqueda->handleRequest($request);
        
        
        $datosVista['formularioBusqueda'] = $formularioBusqueda->createView();
        $datosFormulario = $formularioBusqueda->getData();
//        $datosFormulario['fechaDesde'] = \DateTime::createFromFormat('d/m/Y H:i', $request->request->get('fechaDesde'));
//        $datosFormulario['fechaHasta'] = \DateTime::createFromFormat('d/m/Y H:i', $request->request->get('fechaHasta'));
        
        if ($formularioBusqueda->isValid()){
            $datosVista['eventos'] = $repositorioEventos->buscarEventosPor($datosFormulario);
            return $this->render('RegistroEventosCoreBundle:Evento:supervision.html.twig',$datosVista);
        }
        
        $datosVista['eventos'] = $repositorioEventos->buscarEventosPor($datosFormulario);
        return $this->render('RegistroEventosCoreBundle:Evento:supervision.html.twig',$datosVista);
    }
    
    public function supervisionDetalleEventoAction($id) {
        $repositorioEventos = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Evento');
        
        $evento = $repositorioEventos->find($id);
        $eventos = $repositorioEventos->listarRectificacionesDetallesPara($evento);
        
        return $this->render('RegistroEventosCoreBundle:Evento:detalleEventoSupervision.html.twig',array('eventos' => $eventos));
    }
}
