<?php

namespace RegistroEventos\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use RegistroEventos\CoreBundle\Entity\Usuario;
use RegistroEventos\CoreBundle\Form\UsuarioType;

/**
 * Usuario controller.
 *
 */
class UsuarioController extends Controller
{

    /**
     * Lists all Usuario entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usuarios = $em->getRepository('RegistroEventosCoreBundle:Usuario')->findAll();

        return $this->render('RegistroEventosCoreBundle:Usuario:index.html.twig', array(
            'usuarios' => $usuarios,
        ));
    }
    /**
     * Creates a new Usuario entity.
     *
     */
    public function createAction(Request $request)
    {
        $usuario = new Usuario();
        $form = $this->createCreateForm($usuario);
        $form->handleRequest($request);
        
        $usuario->setRoles(array($form->get('role')->getData()));
        $usuario->setEnabled(true);
        $usuario->setBaja(false);

        $error = null;
        if ($form->isValid()) {
            if ($form['file']->getData()){
                $error = $this->get('registro_eventos_core.subir_imagen')->ValidarImagen($form['file']->getData());
            }
            if ($error == NULL){                
                $em = $this->getDoctrine()->getManager();
                $em->persist($usuario);
                $em->flush();
                if ($form['file']->getData()){
                    $this->get('registro_eventos_core.subir_imagen')->SubirImagen($form['file']->getData(), $usuario->getId());
                }
                return $this->redirect($this->generateUrl('usuarios'));
            }
            
            
            
        }

        return $this->render('RegistroEventosCoreBundle:Usuario:new.html.twig', array(
            'usuario' => $usuario,
            'form'   => $form->createView(),
            'error' => $error,
        ));
    }

    /**
     * Creates a form to create a Usuario entity.
     *
     * @param Usuario $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Usuario $entity)
    {
        $form = $this->createForm(new UsuarioType(), $entity, array(
            'action' => $this->generateUrl('usuarios_create'),
            'method' => 'POST',
            'attr' => array('enctype' => 'multipart/form-data'),
        ));

        $form->add('submit', 'submit', array('label' => 'Crear usuario', 'attr' => array('class' => 'btn btn-success btn-large')));

        return $form;
    }

    /**
     * Displays a form to create a new Usuario entity.
     *
     */
    public function newAction()
    {
        $entity = new Usuario();
        $form   = $this->createCreateForm($entity);

        return $this->render('RegistroEventosCoreBundle:Usuario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'error' => '',
        ));
    }

    /**
     * Displays a form to edit an existing Usuario entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RegistroEventosCoreBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $editForm = $this->createEditForm($entity);
        
        $role = $entity->getRoles();
        $editForm->get('role')->setData($role[0]);
        
        return $this->render('RegistroEventosCoreBundle:Usuario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'error' => '',
        ));
    }

    /**
    * Creates a form to edit a Usuario entity.
    *
    * @param Usuario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Usuario $entity)
    {
        $form = $this->createForm(new UsuarioType(), $entity, array(
            'action' => $this->generateUrl('usuarios_update', array('id' => $entity->getId())),
            'method' => 'POST',
            'attr' => array('enctype' => 'multipart/form-data'),
        ));


        $form->add('submit', 'submit', array('label' => 'Guardar cambios', 'attr' => array('class' => 'btn btn-primary btn-large')));

        return $form;
    }
    /**
     * Edits an existing Usuario entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('RegistroEventosCoreBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        $entity->setRoles(array($editForm->get('role')->getData($request)));
        $error = null;
        if ($editForm->isValid()) {
            if ($editForm['file']->getData()){
                $error = $this->get('registro_eventos_core.subir_imagen')->SubirImagen($editForm['file']->getData(), $id);
            }
            $em->persist($entity);
            $em->flush();

            if ($error == null){
                return $this->redirect($this->generateUrl('usuarios'));
            }
        }

        return $this->render('RegistroEventosCoreBundle:Usuario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'error' => $error,
        ));
    }
    /**
     * Deletes a Usuario entity.
     *
     */
    public function disableAction(Request $request, $id)
    {
        //$form = $this->createDeleteForm($id);
        //$form->handleRequest($request);

        //if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RegistroEventosCoreBundle:Usuario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Usuario entity.');
            }
            $entity->setBaja(TRUE);
            $entity->setEnabled(FALSE);
            $em->persist($entity);
            $em->flush();
        //}

        return $this->redirect($this->generateUrl('usuarios'));
    }

    public function enableAction(Request $request, $id)
    {
        //$form = $this->createDeleteForm($id);
        //$form->handleRequest($request);

        //if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RegistroEventosCoreBundle:Usuario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Usuario entity.');
            }
            $entity->setBaja(FALSE);
            $entity->setEnabled(TRUE);
            $em->persist($entity);
            $em->flush();
        //}

        return $this->redirect($this->generateUrl('usuarios'));
    }
}
