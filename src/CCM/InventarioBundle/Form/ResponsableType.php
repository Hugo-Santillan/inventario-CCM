<?php

namespace CCM\InventarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResponsableType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('telefono')
            ->add('puesto')
            ->add('email')
            ->add('titulo')
            ->add('ubicacion');
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CCM\InventarioBundle\Entity\Responsable'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ccm_inventariobundle_responsable';
    }
}
