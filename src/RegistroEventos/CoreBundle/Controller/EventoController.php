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

        return $this->render('RegistroEventosCoreBundle:Evento:index.html.twig', array(
                    'eventosAbiertos' => $eventosAbiertos,
                    'eventosCerrados' => $eventosCerrados,
                    'form' => $form->createView(),
                    'evento' => $evento
        ));
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


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evento);
            $em->flush();

            return $this->redirect($this->generateUrl('eventos'));
        }

        return $this->render('RegistroEventosCoreBundle:Evento:index.html.twig', array(
                    'evento' => $evento,
                    'form' => $form->createView(),
                    'eventosAbiertos' => $eventosAbiertos,
                    'eventosCerrados' => $eventosCerrados
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

//    public function showAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('RegistroEventosCoreBundle:Evento')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Evento entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('RegistroEventosCoreBundle:Evento:show.html.twig', array(
//                    'entity' => $entity,
//                    'delete_form' => $deleteForm->createView(),
//        ));
//    }

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
        $evento->setFechaDetalle($fechaEvento);
        
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
                'form' => $form->initialize()->createView(),
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

}
