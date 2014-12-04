<?php

namespace RegistroEventos\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use RegistroEventos\CoreBundle\Entity\TipoEvento;
use RegistroEventos\CoreBundle\Form\TipoEventoType;

/**
 * TipoEvento controller.
 *
 */
class TipoEventoController extends Controller
{

    /**
     * Lists all TipoEvento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RegistroEventosCoreBundle:TipoEvento')->listarTiposEventosActivos();

        return $this->render('RegistroEventosCoreBundle:TipoEvento:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TipoEvento entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TipoEvento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipos_eventos'));
        }

        return $this->render('RegistroEventosCoreBundle:TipoEvento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TipoEvento entity.
     *
     * @param TipoEvento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoEvento $entity)
    {
        $form = $this->createForm(new TipoEventoType(), $entity, array(
            'action' => $this->generateUrl('tipos_eventos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear tipo de evento', 'attr' => array('class' => 'btn btn-success btn-large')));

        return $form;
    }

    /**
     * Displays a form to create a new TipoEvento entity.
     *
     */
    public function newAction()
    {
        $entity = new TipoEvento();
        $form   = $this->createCreateForm($entity);

        return $this->render('RegistroEventosCoreBundle:TipoEvento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipoEvento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RegistroEventosCoreBundle:TipoEvento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoEvento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        //$deleteForm->add('submit', 'submit', array('label' => 'Eliminar tipo de evento', 'attr' => array('class' => 'btn btn-danger btn-large pull-right')));
        return $this->render('RegistroEventosCoreBundle:TipoEvento:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TipoEvento entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RegistroEventosCoreBundle:TipoEvento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoEvento entity.');
        }

        $editForm = $this->createEditForm($entity);
        return $this->render('RegistroEventosCoreBundle:TipoEvento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TipoEvento entity.
    *
    * @param TipoEvento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoEvento $entity)
    {
        $form = $this->createForm(new TipoEventoType(), $entity, array(
            'action' => $this->generateUrl('tipos_eventos_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar cambios', 'attr' => array('class' => 'btn btn-primary btn-large')));

        return $form;
    }
    /**
     * Edits an existing TipoEvento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RegistroEventosCoreBundle:TipoEvento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoEvento entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('tipos_eventos'));
        }

        return $this->render('RegistroEventosCoreBundle:TipoEvento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    /**
     * Deletes a TipoEvento entity.
     *
     */
//    public function deleteAction(Request $request, $id)
//    {
//            $em = $this->getDoctrine()->getManager();
//            $entity = $em->getRepository('RegistroEventosCoreBundle:TipoEvento')->find($id);
//
//            if (!$entity) {
//                throw $this->createNotFoundException('Unable to find TipoEvento entity.');
//            }
//            $entity->setBaja(TRUE);
//            $em->persist($entity);
//            $em->flush();
//       
//
//        return $this->redirect($this->generateUrl('tipos_eventos'));
//    }

    /**
     * Creates a form to delete a TipoEvento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
//    private function createDeleteForm($id)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('tipos_eventos_delete', array('id' => $id)))
//            ->setMethod('DELETE')
//            ->add('submit', 'submit', array('label' => 'Delete'))
//            ->getForm()
//        ;
//    }
}
