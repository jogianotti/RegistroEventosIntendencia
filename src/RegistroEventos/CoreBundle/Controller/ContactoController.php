<?php

namespace RegistroEventos\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use RegistroEventos\CoreBundle\Entity\Contacto;
use RegistroEventos\CoreBundle\Form\ContactoType;

/**
 * Contacto controller.
 *
 */
class ContactoController extends Controller
{

    /**
     * Lists all Contacto entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RegistroEventosCoreBundle:Contacto')->findAll();

        return $this->render('RegistroEventosCoreBundle:Contacto:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Contacto entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Contacto();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('agenda'));
        }

        return $this->render('RegistroEventosCoreBundle:Contacto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Contacto entity.
     *
     * @param Contacto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Contacto $entity)
    {
        $form = $this->createForm(new ContactoType(), $entity, array(
            'action' => $this->generateUrl('agenda_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Agendar Contacto', 'attr' => array('class' => 'btn btn-success btn-large')));

        return $form;
    }

    /**
     * Displays a form to create a new Contacto entity.
     *
     */
    public function newAction()
    {
        $entity = new Contacto();
        $form   = $this->createCreateForm($entity);

        return $this->render('RegistroEventosCoreBundle:Contacto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RegistroEventosCoreBundle:Contacto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('El contacto no existe.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RegistroEventosCoreBundle:Contacto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    private function createEditForm(Contacto $entity)
    {
        $form = $this->createForm(new ContactoType(), $entity, array(
            'action' => $this->generateUrl('agenda_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar cambios', 'attr' => array('class' => 'btn btn-primary btn-large')));

        return $form;
    }
    
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $contacto = $em->getRepository('RegistroEventosCoreBundle:Contacto')->find($id);

        if (!$contacto) {
            throw $this->createNotFoundException('Unable to find Contacto entity.');
        }

        $editForm = $this->createEditForm($contacto);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($contacto);
            $em->flush();

            return $this->redirect($this->generateUrl('agenda'));
        }

        return $this->render('RegistroEventosCoreBundle:Contacto:edit.html.twig', array(
            'entity'      => $contacto,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
    /**
     * Deletes a Contacto entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

//        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RegistroEventosCoreBundle:Contacto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contacto entity.');
            }

            $em->remove($entity);
            $em->flush();

//        }

        return $this->redirect($this->generateUrl('agenda'));
    }

    /**
     * Creates a form to delete a Contacto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agenda_delete', array('id' => $id)))
            ->setMethod('GET')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
