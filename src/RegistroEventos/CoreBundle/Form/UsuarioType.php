<?php

namespace RegistroEventos\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('baja')
            ->add('file', 'file', array('mapped' => false, 'required' => false))
            ->add('role','choice', array(
                'choices'   => array('ROLE_INTENDENTE' => 'Intendente','ROLE_SUPERVISOR' => 'Supervisor','ROLE_ADMINISTRADOR' => 'Administrador'),
                'expanded' => false,
                'multiple' => false,
                'required' => true,
                'label' => true,
                'mapped' => false
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RegistroEventos\CoreBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'registroeventos_corebundle_usuario';
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }
}
