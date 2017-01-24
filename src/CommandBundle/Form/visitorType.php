<?php

namespace CommandBundle\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;



class visitorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('firstName', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array('label'=>'Prénom'))
                ->add('lastName', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array('label'=>'Nom'))
                ->add('birthday', DateType::class, array('label' => 'Date de naissance'))
                ->add('country', CountryType::class, array('label' => 'Pays'))
                ->add('discount', CheckboxType::class, array('label' => 'Tarif réduit'))
                        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CommandBundle\Entity\visitor'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'commandbundle_visitor';
    }


}
