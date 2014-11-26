<?php

namespace RegistroEventos\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaSistema')
            ->add('fechaEvento')
            ->add('observaciones')
            ->add('estado','choice', array(
                'choices'   => array(true => 'Abierto', false => 'Cerrado'),
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'label' => true,
            ))
            ->add('usuario')
            ->add('tipoEvento')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RegistroEventos\CoreBundle\Entity\Evento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'registroeventos_corebundle_evento';
    }
}
