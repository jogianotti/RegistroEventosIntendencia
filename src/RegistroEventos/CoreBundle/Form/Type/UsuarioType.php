<?php

namespace RegistroEventos\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

class UsuarioType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('password')
            ->add('roles', 'choice', array(
                'choice_list' => new ChoiceList(
                                        array('ROLE_ADMINISTRADOR','ROLE_SUPERVISOR','ROLE_INTENDENTE'),
                                        array( 'Administrador','Supervisor','Intendente')
                                    ),
                'required'  => true,
                'multiple' => false,
                
            ))
            ->add('nombre')
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
}
