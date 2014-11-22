<?php

namespace RegistroEventos\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use RegistroEventos\CoreBundle\Entity\Evento;
use RegistroEventos\CoreBundle\Form\EventoType;

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

        $entity = new Evento();
        $form   = $this->createCreateForm($entity);

        $eventos = $em->getRepository('RegistroEventosCoreBundle:Evento')->findAll();//buscarEventosActivos();

        return $this->render('RegistroEventosCoreBundle:Evento:index.html.twig', array(
            'eventos' => $eventos,
            'form'   => $form->createView()
        ));
    }
    /**
     * Creates a new Evento entity.
     *
     */
    public function createAction(Request $request)
    {
        $evento = new Evento();
        $form = $this->createCreateForm($evento);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $evento->setFechaSistema(new \DateTime());
            $evento->setUsuario($this->get('security.context')->getToken()->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($evento);
            $em->flush();

            return $this->redirect($this->generateUrl('eventos', array('id' => $evento->getId())));
        }

        return $this->render('RegistroEventosCoreBundle:Evento:new.html.twig', array(
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
            'action' => $this->generateUrl('eventos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Evento entity.
     *
     */
    public function newAction()
    {
        $entity = new Evento();
        $form   = $this->createCreateForm($entity);

        return $this->render('RegistroEventosCoreBundle:Evento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

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
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RegistroEventosCoreBundle:Evento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evento entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RegistroEventosCoreBundle:Evento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Evento entity.
    *
    * @param Evento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Evento $entity)
    {
        $form = $this->createForm(new EventoType(), $entity, array(
            'action' => $this->generateUrl('eventos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Evento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RegistroEventosCoreBundle:Evento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('eventos_edit', array('id' => $id)));
        }

        return $this->render('RegistroEventosCoreBundle:Evento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Evento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RegistroEventosCoreBundle:Evento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Evento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('eventos'));
    }

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

    public function newRectificacionAction(Request $request){
        $id = $request->query->get('id');
        $eventoRectificado = $this->getDoctrine()->getManager()->getRepository('RegistroEventosCoreBundle:Evento')->findOneBy(array('id' => $id));
        $entity = new Evento();

        $form = $this->createForm(new EventoType(), $entity, array(
            'action' => $this->generateUrl('eventos_rectificacion_crear'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        if ($id == null){
            return $this->render('RegistroEventosCoreBundle:Evento:rectificar.html.twig', array(
                'error' => true
            ));
        }else{
            return $this->render('RegistroEventosCoreBundle:Evento:rectificar.html.twig', array(
                'form' => $form->createView(),
                'entity'      => $entity,
                'eventoRectificado' => $eventoRectificado->getId(),
                'error' => false
            ));
        }
    }

    public function crearRectificacionAction(Request $request){
        $evento = new Evento();
        $form = $this->createForm(new EventoType(), $entity, array(
            'action' => $this->generateUrl('eventos_rectificacion_crear'),
            'method' => 'POST',
        ));
        $form->handleRequest($request);

        $entity = new Evento();

        if ($form->isValid()) {
            //Buscar evento con ID: (REQUEST[registroeventos_corebundle_evento_rectificar])
            //y setearle el campo BAJA "rectificacion" en $evento->getId();
            $evento->setFechaSistema(new \DateTime());
            $evento->setUsuario($this->get('security.context')->getToken()->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($evento);
            $em->flush();

            return $this->redirect($this->generateUrl('eventos', array('id' => $evento->getId())));
        }

    }
}
