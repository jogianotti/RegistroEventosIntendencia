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

    /**
     * Listado de todos los Eventos.
     *
     */
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
            'form'   => $form->createView()
        ));
        print_r('LLEGUE'); die();
    }
    /**
     * Creates a new Evento entity.
     *
     */
    public function crearAction(Request $request)
    {
        $evento = new Evento();
        $form = $this->createCreateForm($evento);
        $form->handleRequest($request);
        
        $date = \DateTime::createFromFormat('d-m-y H:i', $request->request->get('fechaEvento'));
        $evento->setFechaEvento($date);

        if ($form->isValid()) {
            $evento->setFechaSistema(new \DateTime());
            $evento->setUsuario($this->get('security.context')->getToken()->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($evento);
            $em->flush();
            
            return $this->redirect($this->generateUrl('eventos'));
        }

        return $this->render('RegistroEventosCoreBundle:Evento:index.html.twig', array(
            'evento' => $evento,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Crea un formulario para crear una entidad Evento.
     *
     * @param Evento $entity La entidad
     *
     * @return \Symfony\Component\Form\Form El formulario
     */
    private function createCreateForm(Evento $entity)
    {
        $form = $this->createForm(new EventoType(), $entity, array(
            'action' => $this->generateUrl('eventos_crear'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Evento entity.
     *
     */
//    public function newAction()
//    {
//        $evento = new Evento();
//        $formulario = $this->createCreateForm($evento);
//
//        $vista = $this->renderView('RegistroEventosCoreBundle:Evento:new.html.twig', 
//        ['formulario' => $formulario->createView()]);
//        
//        return new JsonResponse(array('contenido' => $vista));
//    }

    /**
     * Finds and displays a Evento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RegistroEventosCoreBundle:Evento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RegistroEventosCoreBundle:Evento:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Evento entity.
     *
     */
//    public function editAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('RegistroEventosCoreBundle:Evento')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Evento entity.');
//        }
//
//        $editForm = $this->createEditForm($entity);
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('RegistroEventosCoreBundle:Evento:edit.html.twig', array(
//            'entity'      => $entity,
//            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//    * Creates a form to edit a Evento entity.
//    *
//    * @param Evento $entity The entity
//    *
//    * @return \Symfony\Component\Form\Form The form
//    */
//    private function createEditForm(Evento $entity)
//    {
//        $form = $this->createForm(new EventoType(), $entity, array(
//            'action' => $this->generateUrl('eventos_update', array('id' => $entity->getId())),
//            'method' => 'PUT',
//        ));
//
//        $form->add('submit', 'submit', array('label' => 'Update'));
//
//        return $form;
//    }
    /**
     * Edits an existing Evento entity.
     *
     */
//    public function updateAction(Request $request, $id)
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
//        $editForm = $this->createEditForm($entity);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isValid()) {
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('eventos_edit', array('id' => $id)));
//        }
//
//        return $this->render('RegistroEventosCoreBundle:Evento:edit.html.twig', array(
//            'entity'      => $entity,
//            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
    /**
     * Deletes a Evento entity.
     *
     */
//    public function deleteAction(Request $request, $id)
//    {
//        $form = $this->createDeleteForm($id);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $entity = $em->getRepository('RegistroEventosCoreBundle:Evento')->find($id);
//
//            if (!$entity) {
//                throw $this->createNotFoundException('Unable to find Evento entity.');
//            }
//
//            $em->remove($entity);
//            $em->flush();
//        }
//
//        return $this->redirect($this->generateUrl('eventos'));
//    }

    /**
     * Creates a form to delete a Evento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('eventos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }

    public function nuevaRectificacionAction(Request $request){
        $id = $request->request->get('id',NULL);
        $eventoRectificado = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Evento')->findOneBy(array('id' => $id));
        
        $rectificacion = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Evento')->findOneBy(array('rectificacion' => $eventoRectificado));
        $rectificaciones = null;
        while ($rectificacion != NULL){
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
            'method' => 'POST'
        ));
        
        if($id === NULL){
            return $this->render('RegistroEventosCoreBundle:Evento:rectificar.html.twig', array(
                'error' => true
            ));
        }else{
            return $this->render('RegistroEventosCoreBundle:Evento:rectificar.html.twig', array(
                'form' => $form->createView(),
                'eventoRectificado' => $eventoRectificado,
                'rectificaciones' => $rectificaciones,
                'error' => false
            ));
        }
    }

    public function crearRectificacionAction(Request $request){
        $id = $request->request->get('eventoRectificadoId',NULL);
        
        $evento = new Evento();
        $form = $this->createForm(new EventoType(), $evento);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $evento->setFechaSistema(new \DateTime());
            $evento->setUsuario($this->get('security.context')->getToken()->getUser());
            
            $em->persist($evento);
            $em->flush();
            
            $eventoRectificado = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Evento')->findOneBy(array('id' => $id));
            $eventoRectificado->setRectificacion($evento);
            
            $em->persist($eventoRectificado);
            $em->flush();
            
            return new JsonResponse(array('rectificado' => TRUE));
//            return $this->redirect($this->generateUrl('eventos'));
        }
        $vista = $this->renderView('RegistroEventosCoreBundle:Evento:rectificar.html.twig', array(
                'form' => $form->createView(),
                'eventoRectificado' => $eventoRectificado,
                'error' => false
            ));
        return new JsonResponse(array('rectificado' => FALSE, 'html' => $vista));
    }
    
    public function cerrarEventoAction($id){
        $em = $this->getDoctrine()->getManager();
        $evento = $em->getRepository('RegistroEventosCoreBundle:Evento')->findOneBy(array('id' => $id));
        $evento->setEstado(FALSE);
        
        $em->persist($evento);
        $em->flush();
        
        return $this->redirect($this->generateUrl('eventos'));//'RegistroEventosCoreBundle:Evento:index');
    }
    
    public function abrirEventoAction($id){
        $em = $this->getDoctrine()->getManager();
        $evento = $em->getRepository('RegistroEventosCoreBundle:Evento')->findOneBy(array('id' => $id));
        $evento->setEstado(TRUE);
        
        $em->persist($evento);
        $em->flush();
        
        return $this->redirect($this->generateUrl('eventos'));//    forward('RegistroEventosCoreBundle:Evento:index');
    }
    
    public function detalleEventoAction($id) {
        
        $em = $this->getDoctrine()->getManager();
        $evento = $em->getRepository('RegistroEventosCoreBundle:Evento')->findOneBy(array('id' => $id));
        
        $detalle = new Detalle();
        $detalle->setFechaDetalle(new \DateTime());
        $form = $this->createForm(new DetalleType(), $detalle);
        
        return $this->render('RegistroEventosCoreBundle:Evento:detalle.html.twig',array('form' => $form->createView(),'detalles'=>array(),'evento'=>$evento));
    }
    
    public function crearDetalleEventoAction(Request $request){
        
        $eventoId = $request->request->get('eventoId');
        $em = $this->getDoctrine()->getManager();
        $evento = $em->getRepository('RegistroEventosCoreBundle:Evento')->findOneBy(array('id' => $eventoId));
        
        $detalle = new Detalle();
        $form = $this->createForm(new DetalleType(), $detalle);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $detalle->setFechaSistema(new \DateTime());
            $detalle->setUsuario($this->get('security.context')->getToken()->getUser());
            
            $em->persist($detalle);
            $em->flush();
            
            $detalles = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Evento')->listarDetallesPara($evento);
            $vista = $this->renderView('RegistroEventosCoreBundle:Evento:detalle.html.twig', array(
                'form' => $form->createView(),
                'detalles' => $detalles
            ));
            return new JsonResponse(array('agregado' => TRUE,'html'=> $vista));
        }
        $detalles = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Evento')->listarDetallesPara($evento);
        $vista = $this->renderView('RegistroEventosCoreBundle:Evento:detalle.html.twig', array(
            'form' => $form->createView(),
            'detalles' => $detalles
        ));
        return new JsonResponse(array('agregado' => FALSE, 'html' => $vista));
    }
}
